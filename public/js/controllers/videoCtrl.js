var module = angular.module('videoCtrl', []);

module.controller('listCtrl', function($scope, $http, Video, Tag) {
        $scope.videoData    = {};
        $scope.videos       = [];
        $scope.loading      = true;
        $scope.settings     = [];
        $scope.showAddForm  = false;

        $scope.toggleAddForm = function() {
            $scope.showAddForm = !$scope.showAddForm;
        };

        Video.get().success(function(data) {
            $scope.videos = data;
            $scope.loading = false;
        });

        $scope.videoChunks = function () {
            var range = [];
            for( var i = 0; i < $scope.videos.length; i += 4 ) {
                range.push(i);
            }
            return range;
        };

        $scope.submitVideo = function() {
            $scope.loading = true;

            var video = $scope.videoData;
            $scope.videos.push(video);


            Video.save(video).success(function(data) {
                $scope.loading      = false;
                $scope.videoData    = {};
                $scope.videoForm.$setPristine();
                $scope.showAddForm = false;
            }).error(function(data) {
                $scope.loading      = false;
                console.log(data);
            });


        };

        $scope.deleteVideo = function(id) {
            $scope.loading = true;

            var video= $scope.videos[id];
            Video.destroy(video.id)
                .success(function(data) {
                    $scope.videos.splice(id, 1);
                    $scope.loading = false;
                }).error(function(data) {
                    $scope.loading = false;
                    console.log(data);
                });
        };

        $scope.setVideoWatched = function (id) {
            $scope.loading = true;

            var video= $scope.videos[id];

            Video.setWatched(video.id)
                .success(function(data) {
                    $scope.videos.splice(id, 1);
                    $scope.loading = false;
                }).error(function(data) {
                    $scope.loading = false;
                    console.log(data);
                });
        }

        $scope.loadTags = function(query) {
            return Tag.get();
        };
    });

module.controller('videoCtrl', function($scope) {
    $scope.showSettings = false;

    $scope.toggleSettings = function() {
        console.log("here");
        $scope.showSettings = !$scope.showSettings;
    };
});