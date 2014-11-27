var videoApp = angular.module('videoApp', ['ui.bootstrap', 'ngTagsInput', 'videoCtrl', 'videoService', 'tagService']);

videoApp.filter('splitArray', function() {
    return function(array, chunkSize) {

        if (array.length < 1) {
            return arrray;
        }

        var chunked = [];
        var i =0;
        var length = arrray.length;

        for (i = 0; i < length; i += chunkSize ) {
            chunked.push(array.slice(i, i + chunkSize));
        }

        console.log(chunked);
        return chunked;
    }
});

videoApp.directive('youtubeLinkValidator', function(){
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, modelCtrl) {

            modelCtrl.$parsers.push(function (inputValue) {
                console.log("lol");
                var transformedInput = inputValue;
                var matches          = inputValue.match(/^https?:\/\/www.youtube.com\/watch\?v=([a-zA-Z0-9_-]{11})/);

                if (matches) {
                    var transformedInput = matches[1];
                    if (transformedInput != inputValue) {
                        modelCtrl.$setViewValue(transformedInput);
                        modelCtrl.$render();
                    }
                }

                return transformedInput;
            });
        }
    };
});