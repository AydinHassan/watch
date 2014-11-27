angular.module('videoService', [])

    .factory('Video', function($http) {

        return {
            // get all the comments
            get : function() {
                return $http.get('/api/videos');
            },

            // save a comment (pass in comment data)
            save : function(videoData) {
                return $http({
                    method: 'POST',
                    url: '/api/videos',
                    data: videoData
                });
            },

            // destroy a comment
            destroy : function(id) {
                return $http.delete('/api/videos/' + id);
            },

            setWatched : function(id) {
                return $http({
                    method: 'PATCH',
                    url: '/api/videos/' + id,
                    data: {is_watched: true}
                });
            }
        }

    });
	
	