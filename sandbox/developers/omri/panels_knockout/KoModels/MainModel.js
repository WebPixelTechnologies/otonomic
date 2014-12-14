var MainModel = function (loadData) {

    var self = this;

    self.bindedAttributes = ['title', 'address', 'phone', 'email'];

    self.bindedAttributes.forEach( function(element, index, array) {
        self[element] = ko.observable();

        // eval('self.'+element+' = ko.observable();');
    });

    self.editWindowtitle = ko.observable();
    self.testimonials = ko.observableArray([]);
    self.selectedTestimonial = null;
    self.jQ = $;
    

    self.appearance = {
        font: ko.observable(),
        bgColor: ko.observable().subscribeTo("bgColor")
    }
    self.appearanceOld =
        {
            font: '',
            bgColor:''
        };

    self.getData = function () {
        self.jQ.getJSON("get_data.php", function (data) {
            for (var item in data.testimonials) {
                data.testimonials[item].showBtnGroup = ko.observable();
                data.testimonials[item].hideItem = ko.observable();
                data.testimonials[item].showBtnGroup(false);
                data.testimonials[item].hideItem(false);
                data.testimonials[item].fontStyle = ko.observable(data.appearance.font).subscribeTo("fontStyle");

            }
            
            self.appearance.font(data.appearance.font);
            self.appearance.bgColor(data.appearance.bg_color);
            self.appearanceOld.font = data.appearance.font;
            self.appearanceOld.bgColor = data.appearance.bgColor;
            self.testimonials(data.testimonials);

            self.bindedAttributes.forEach( function(element, index, array) {
                (self[element])(data[element]);
            });
        })
    }
    //if (loadData == true)
    self.getData();

   
    self.add = function ()
    {        
        self.editWindowtitle("Adding New Testimonial");
        self.selectedTestimonial = {
            id:0,
            name: '',
            review: '',
            src: '',
            rating: 0,
            showBtnGroup: ko.observable(),
            hideItem: ko.observable()
        };
    }
    
    self.edit = function (testimonial) {
        self.editWindowtitle("Editing Testimonial");
        self.selectedTestimonial = testimonial;
    }

    self.save = function ()
    {
        var data = self.selectedTestimonial;
        self.jQ.post("http://localhost:11114/tm/savetestimonial", data, function (pData) {
            alert(pData);
            //var record = self.findTestimonials(data.id);
            self.getData();
        })

    }
    self.saveSite = function () {
        var data = {
            name: self.siteName(),
            font: self.appearance.font(),
            bg_color: self.appearance.bgColor(),
            title:self.title()


        }
        self.jQ.post("http://localhost:11114/tm/savesite", data, function (pData) {
            self.appearanceOld.font = data.font;
            self.appearanceOld.bgColor = data.bg_color;
            alert(pData);
        });
    }
    self.cancelSite = function () {
        self.appearance.font(self.appearanceOld.font);
        self.appearance.bgColor(self.appearanceOld.bgColor);
    }
    self.saveAll = function () {
        var stringData=ko.toJSON(self);
        self.jQ.post("http://localhost:11114/tm/saveall", { json: stringData }, function (pData) {
            alert(pData);
        })
    };

        

    self.findTestimonials = function (id) {
        return ko.utils.arrayFilter(this.testimonials(), function (tm) {
            return (tm.id === id);
        });
    };

    self.updatPopoverData = function (fromModel,propertyName) {
        fromModel[propertyName](self[propertyName]());
        
    }

    self.add();
};
