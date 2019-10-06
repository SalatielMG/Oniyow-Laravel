<?php

namespace oniyow\Http\Controllers\Auth;


use oniyow\Model\Cliente;
use oniyow\Model\Email;
use oniyow\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use oniyow\Model\Dato;
use oniyow\Model\Telefono;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $registroCliente = array();
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*public function variableSession($telefonos, $emails){
        session( ["telefonos" => json_decode($telefonos)]);
        session( ["emails" => json_decode($emails)]);
        //dd(session("telefonos"));
    }*/
    public function showRegistrationForm($e = "")
    {
        return view('auth.register', compact("e"));
    }

    /*public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }*/

    protected function validator(array $data)
    {
        //dd($data["telefonos"]);
        $telefonos = json_decode($data["telefonos"]);
        $emails = json_decode($data["correos"]);
        //dd($telefonos);
        foreach($telefonos as $tel){
            $t = ["tel" => $tel -> tel];
            //dd($t);
            $v =  Validator::make($t, [
                'tel' => 'required|digits:10|unique:telefono,numero',
            ]);
            //dd($v -> fails());
            if($v -> fails()){
                return $v;
            }

        }
        foreach($emails as $email){
            $t = ["email" => $email -> email];
            //dd($t);
            $v =  Validator::make($t, [
                'email' => 'required|email|unique:email,email',
            ]);
            //dd($v -> fails());
            if($v -> fails()){
                return $v;
            }

        }

        if($data["tipo"] == "empresa"){
            $holi = Validator::make($data, [
                'razonSocial' => 'required|string|max:100',
                'representanteLegal' => 'required|string|max:200',
                'sitioWeb' => 'max:200',
                'domicilioParticular' => 'required|string|max:255',
                'usuario' => 'required|string|max:100|unique:cliente,usuario',
                'password' => 'required|string|min:6|confirmed',
            ]);
            return $holi;
        }else{
            return Validator::make($data, [
                'nombre' => 'required|string|max:100',
                'apellido' => 'required|string|max:100',
                'domicilioParticular' => 'required|string|max:255',
                'usuario' => 'required|string|max:100|unique:cliente,usuario',
                'password' => 'required|string|min:6|confirmed',
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     * @param  array  $data
     * @return \oniyow\Cliente
     */
    protected function create(array $data)
    {
        /*
         * 1.- Se crea el objeto dato.
         * 2.- Se crea el objeto cliente.
         * 3.- Tamien se deben de crear los telefonos y los emails.
         * */

        $tipo = $data["tipo"];
        //$this -> registroCliente = [];
        //$this -> registroCliente["usuario"] = null;
        //$this -> registroCliente["msj"] = "No se pudo crear el registro base del cliente " . $tipo;
        $Dato = Dato::create([
            'domicilioparticular' => $data['domicilioParticular'],
            'sitioWeb' => ($tipo == "empresa") ? $data['sitioWeb'] : null,
        ]);
        $id_dato = $Dato -> id;
        if($tipo == "empresa") if (auth() -> guest()) if (count(Cliente::where('tipo', 'admin') -> get()) == 0) $tipo = "admin";

        if($Dato){
            $this -> crearTelefonosEmails($id_dato, json_decode($data["telefonos"]), json_decode($data["correos"]));
            //$this -> registroCliente["msj"] = "No se pudo crear el registro de Cliente. Revise la informacion proporcionada";
            try{
                $cliente = Cliente::create([
                    'dato' => $id_dato,
                    'nombre' => ($tipo == "empresa" || $tipo == "admin") ? $data["razonSocial"] : $data["nombre"],
                    'apellido' => ($tipo == "empresa" || $tipo == "admin") ? $data["representanteLegal"] : $data["apellido"],
                    'tipo' => $tipo,
                    'usuario' => $data['usuario'],
                    'password' => bcrypt($data['password']),
                ]);
                if($cliente){
                    //$this -> registroCliente["msj"] = "El registro se completo correctamente";
                    //$this -> registroCliente["usuario"] = $cliente;
                    $telfs = json_decode($data["telefonos"]);
                    foreach ($telfs as $tel => $value){
                        $this -> enviarWatsh($cliente -> nombre, $value -> tel);
                        //$value -> tel
                    }
                    return $cliente;
                }
            }catch(\Exception $e){
                return null;
            }
        }else return null;
    }
    public function enviarWatsh($nombre, $tel)
    {
        $data = [
            'phone' => "+521$tel", // Receivers phone
            'body' => "Hola querido Cliente: $nombre, Agradecemos su preferencia, Gracias por formar parte de nuestro red de clientes. Quedamos a su servicio.", // Message
        ];
        $json = json_encode($data); // Encode data to JSON
// URL for request POST /message
        $url = 'https://eu37.chat-api.com/instance44997/message?token=p4mvq6rxwi23vcaz';
// Make a POST request
        $options = stream_context_create(['http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $json
        ]
        ]);
// Send a request
        $result = file_get_contents($url, false, $options);
        return $result;
    }
    private function crearTelefonosEmails($idDato, $telefonos, $correos){
        $error = 0;
        $this -> registroCliente["error-telefonos"] = "Los siguientes telefonos no se pudieron registrar: ";
        foreach ($telefonos as $tel => $value){
            //dd($value);
            try{
                Telefono::create([
                    'numero' => $value -> tel,
                    'dato' => $idDato,
                ]);
            }catch (\Exception $e){
                $error ++;
                $this -> registroCliente["error-tel"] = $error;
                $this -> registroCliente["error-telefonos"] = $this -> registroCliente["error-telefonos"] . $value . ", ";
            }
        }
        $error = 0;
        $this -> registroCliente["error-correos"] = "Los siguientes emais no se pudieron registrar: ";
        foreach ($correos as $mail => $value){
            try{
                Email::create([
                    'email' => $value -> email,
                    'dato' => $idDato,
                ]);
            }catch(\Exception $e){
                $error ++;
                $this -> registroCliente["error-email"] = $error;
                $this -> registroCliente["error-correos"] = $this -> registroCliente["error-correos"] . $value . ", ";
            }
        }
    }
}
