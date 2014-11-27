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