// Register component, so <addeditmodal></addeditmodal> shows html from the specified template file
ko.components.register('addeditmodal', {
    viewModel: { viaLoader: ' ' },
    template: {
        fromUrl: 'KoViews/TestimonialEdit.html', maxCacheAge: 1234, onLoaded: function () {
         
        }
    },
});
ko.components.register('testimonialsmodal', {
    viewModel: { viaLoader: ' ' },
    template: {
        fromUrl: 'KoViews/Testimonials.html', maxCacheAge: 1234, onLoaded: function () {
           
        }
    },
});

/*
ko.components.register('popover', {
    viewModel: { viaLoader: ' ' },
    template: 
           '<div id="popoverBusinessName" class="ko-popover">\
            <div class="form-group">\
                <label for="business-Name">Business Name</label>\
                <input type="text" class="form-control" id="business-Name" data-bind="value: title" name="business-Name"  placeholder="">\
            </div>\
            <div class="popover-footer text-right">\
                <button type="button" class="btn btn-link cancelPopover" data-dismiss="popover"><span class="glyphicons remove_2"></span>Cancel</button>\
                <button type="button" class="btn btn-oto-green savePopover" data-bind="click:saveBusinessName" data-dismiss="popover"><span class="glyphicons ok_2" ></span>Save</button>\
            </div>\
        </div>'
    });
*/

ko.components.register('sidebar', {
    viewModel: { viaLoader: ' ' },
    template: {
        fromUrl: 'KoViews/SideBar.html',
        maxCacheAge: 1234,
        onLoaded: function () {
            var sideBar = document.getElementById("sideBar");
            ko.cleanNode(sideBar);
            ko.applyBindings(MyApp.VM, sideBar);

            $('#colorSelector div').css('backgroundColor', MyApp.VM.appearance.bgColor());
            $('#colorSelector').ColorPicker({
                color: MyApp.VM.appearance.bgColor(),
                onShow: function (colpkr) {
                    $(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    // QUESTION: Why isn't there a binding here?
                    $('#colorSelector div').css('backgroundColor', '#' + hex);
                    MyApp.VM.appearance.bgColor('#' + hex);
                    // TODO: Understand what ko.postbox does
                    ko.postbox.publish("bgColor", '#' + hex);
                }
            });

            $('#fontSelect').fontSelector({
                'hide_fallbacks': true,
                'initial': MyApp.VM.appearance.font(),
                'selected': function (style) {
                    MyApp.VM.appearance.font(style)
                    ko.postbox.publish("fontStyle", style);
                    //alert("S1: " + style);
                },
                'fonts': [
                  'Arial,Arial,Helvetica,sans-serif',
                  'Arial Black,Arial Black,Gadget,sans-serif',
                  'Comic Sans MS,Comic Sans MS,cursive',
                  'Courier New,Courier New,Courier,monospace',
                  'Georgia,Georgia,serif',
                  'Impact,Charcoal,sans-serif',
                  'Lucida Console,Monaco,monospace',
                  'Lucida Sans Unicode,Lucida Grande,sans-serif',
                  'Palatino Linotype,Book Antiqua,Palatino,serif',
                  'Tahoma,Geneva,sans-serif',
                  'Times New Roman,Times,serif',
                  'Trebuchet MS,Helvetica,sans-serif',
                  'Verdana,Geneva,sans-serif',
                  'Gill Sans,Geneva,sans-serif'
                ]
            });

        }
    },
});

var templateFromUrlLoader = {
    loadTemplate: function (name, templateConfig, callback) {
        if (templateConfig.fromUrl) {
            // Uses jQuery's ajax facility to load the markup from a file
            var fullUrl = templateConfig.fromUrl + '?cacheAge=' + templateConfig.maxCacheAge;
            $.get(fullUrl, function (markupString) {
                // We need an array of DOM nodes, not a string.
                // We can use the default loader to convert to the
                // required format.

                ko.components.defaultLoader.loadTemplate(name, markupString, callback);
                templateConfig.onLoaded();
            });
        } else {
            // Unrecognized config format. Let another loader handle it.
            callback();
        }
    }
};

// QUESTION: What does this do?
ko.components.loaders.unshift(templateFromUrlLoader);

// QUESTION: What does this do?
var viewModelCustomLoader = {
    loadViewModel: function (name, viewModelConfig, callback) {
        if (viewModelConfig.viaLoader) {
           
            ko.components.defaultLoader.loadViewModel(name, MainModel, callback);
        } else {
            // Unrecognized config format. Let another loader handle it.
            callback(null);
        }
    }
};


ko.components.loaders.unshift(viewModelCustomLoader);
//ko.applyBindings();
