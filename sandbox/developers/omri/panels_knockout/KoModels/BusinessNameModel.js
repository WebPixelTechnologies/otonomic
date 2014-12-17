var BusinessNameModel = function (parentModel) {
    var self = this;

    /*
    self.title = ko.observable();
    self.address = ko.observable();
    */

    self.saveSiteValue = function (propName) {

        /*
        $.post("http://localhost:11114/tm/savebusinessname", {
                propName: propName,
                propValue: self[propName]()
            },
            function (pData) {
                alert(pData);
                if (parentModel)
                    parentModel[propName](self[propName]());
            }
        )
        */

        if (parentModel) {
            parentModel[propName](self[propName]());
        }
    }
}