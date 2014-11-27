angular.module('tagService', [])

    .factory('Tag', function($http) {

        return {
            // get all the comments
            get : function() {
                return $http.get('/api/tags');
            }
        }

    });

