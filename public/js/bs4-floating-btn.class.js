class FloatingBtn {
    constructor(element=undefined, options={}) {
        try {
            if (typeof element === "undefined") {
                throw "Error: HTML not found"
            }

            this.element = document.querySelector(element);
            this.button = undefined;
            this.options = options;
            this.init();
        } catch (e) {
            if (typeof logError !== "undefined") {
                logError(e, 'Floating btn ');
            } else {
                console.error("Log not found");
            }
        }
    }

    template() {
        var containerClass = '',
            btnClass = 'btn btn-lg btn-success floating-btn',
            btnText = '<i class="fa fa-fw fa-plus" aria-hidden="true"></i>',
            btnTitle = 'Agregar',
            templateString = `
        <div class="d-flex flex-row-reverse ${containerClass}">
          <button type="button" class="${btnClass}" title="${btnTitle}">${btnText}</button>
        </div>`;

        this.button = '.floating-btn';

        return templateString;
    }

    on(eventType='click', fn) {
        if (typeof fn === "function") {
            document.querySelector(this.button).addEventListener(eventType, fn);
        }

        return false;
    }

    init() {
        var generatedTemplate = this.template();
        this.element.innerHTML = generatedTemplate;
    }
}

