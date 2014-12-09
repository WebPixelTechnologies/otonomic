ko.bindingHandlers.popover = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        var value = ko.utils.unwrapObservable(valueAccessor()),
            popoverName = value.popoverName,
            template = value.template,
            propName = value.propName;

        var tempalateHtml = $("#"+template).html();
        var popoverId = popoverName;
        var model = new BusinessNameModel(MyApp.VM);

        // QUESTION: Wht does this do?
        var childBindingContext = bindingContext.createChildContext(model);

        // Set default values for popover
        var options = { content: tempalateHtml, title: "" };
        options = $.extend({}, ko.bindingHandlers.popover.options, options);

        return $(element).bind("click", function () {
            event.returnValue = false;
            if (event.preventDefault) event.preventDefault();
            var method = "toggle", el = $(this);

            el.popover(options).popover(method);
            var n = $("#" + popoverId);

            // QUESTION: wdtd?
            $(".ko-popover").not(n).parents(".popover").remove(), $("#" + popoverId).is(":visible") && ko.applyBindingsToDescendants(childBindingContext, $("#" + popoverId)[0]);

            if ($("#" + popoverId).is(":visible")) {
                //model.title(viewModel.title());
                viewModel.updatPopoverData(model, propName);
                $("#" + popoverId + "  input[type=text]").focus();
            }

            $(document).on("click", '.btn.btn-link.cancelPopover', function () {

                viewModel.updatPopoverData(model, propName);
                //model.title(viewModel.title());
                el.popover("hide");
            });

            $(document).on("click", '.btn.btn-oto-green.savePopover', function () {
                el.popover("hide");
            });

        }), { controlsDescendantBindings: false }
    },

    this.options = {
        placement: "bottom",
        html: true,
        trigger: "manual",
        template: '<div class="otonomic-core-style popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }
};


ko.bindingHandlers.testimonialItem = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {

        return $(element).hover(
            function () {
                viewModel.showBtnGroup(true);
            }, function () {
                viewModel.showBtnGroup('false');
            }
        );
    }
}

// QUESTION: Why use jquery
ko.bindingHandlers.showEye= new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        return $(element).bind("click", function () {         
            viewModel.hideItem(true);         
        });
    }
}

ko.bindingHandlers.hideEye = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        return $(element).bind("click", function () {            
            viewModel.hideItem(false);
        });
    }
}


ko.bindingHandlers.addItem = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        
        return $(element).bind("click", function () {
            viewModel.add();
            ko.cleanNode($("#addEditModal")[0]);
            ko.applyBindings(viewModel, $("#addEditModal")[0])
        });
    }
}

ko.bindingHandlers.editItem = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        
        return $(element).bind("click", function ()
        {
            var model = bindingContext.$parentContext.$parent;
            model.edit(viewModel);
            ko.cleanNode($("#addEditModal")[0]);
            ko.applyBindings(model, $("#addEditModal")[0])
        });
    }
}

ko.bindingHandlers.saveItem = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {

        return $(element).bind("click", function () {
            var model = bindingContext.$root;
            model.save(viewModel);
            ko.cleanNode($("#addEditModal")[0]);
            ko.applyBindings(model, $("#addEditModal")[0])
        });
    }
}

ko.bindingHandlers.hideSideBar = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        return $(element).bind("click", function () {
            $("#sideBar").hide();
        });
    }
}

ko.bindingHandlers.showSideBar = new function () {
    this.init = function (element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
        return $(element).bind("click", function () {
            $("#sideBar").show();
        });
    }
}
