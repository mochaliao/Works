(function () {
    'use strict';

    angular
        .module('VipApp')
        .service('DialogService', DialogService);

    DialogService.$inject = ['ngDialog'];

    function DialogService(ngDialog) {

        var self = this;

        self.OpenMessage = function(showmode, title, content, confirmCB, cancelCB) {
            ngDialog.openConfirm(
            {
                template : 'view/dialog.htm',
                controller : 'DialogController', 
                width : 300,
                data : 
                {
                    mode : showmode,
                    title : title,
                    content : content,
                    confirmCB : confirmCB,
                    cancelCB : cancelCB
                }
            });
        }
    }
})();
