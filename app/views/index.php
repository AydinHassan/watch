<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Watch List</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/ng-tags-input.min.css">
        <link rel="stylesheet" href="css/app.css">

        <!-- JS -->
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>
        <script src="js/ui-bootstrap-tpls-0.12.0.min.js"></script>
        <script src="js/ng-tags-input.min.js"></script>

        <!-- ANGULAR -->
        <!-- all angular resources will be loaded from the /public folder -->
        <script src="js/controllers/videoCtrl.js"></script> <!-- load our controller -->
        <script src="js/services/videoService.js"></script> <!-- load our service -->
        <script src="js/services/tagService.js"></script> <!-- load our service -->
        <script src="js/app.js"></script> <!-- load our application -->

    </head>
    <body class="" ng-app="videoApp" ng-controller="listCtrl">


        <div class="container">
            <div class="row header">
                <div class="col-lg-3 col-lg-offset-4">
                    <div class="text-center">
                        <span ng-click="toggleAddForm()" class="text-center add-video glyphicon glyphicon-plus-sign"></span>
                    </div>

                    <form id="addForm" name="videoForm" class="text-center" ng-submit="submitVideo()" novalidate ng-show="showAddForm">
                        <div class="form-group has-feedback" ng-class="{ 'has-error': videoForm.youtube_id.$invalid && !videoForm.youtube_id.$pristine, 'has-success': videoForm.youtube_id.$valid && !videoForm.youtube_id.$pristine }">
                            <input ng-model="videoData.youtube_id" type="text" class="form-control" name="youtube_id" id="youtube_id" placeholder="Youtube Link or ID" required ng-pattern="/^[a-zA-Z0-9_-]{11}|^(http|https):\/\/www.youtube.com\/watch\?v=[a-zA-Z0-9_-]{11}/" aria-describedby="youtube_idStatus" youtube-link-validator>
                            <span ng-show="videoForm.youtube_id.$invalid && !videoForm.youtube_id.$pristine" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                            <span ng-show="videoForm.youtube_id.$valid && !videoForm.youtube_id.$pristine" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback" ng-class="{ 'has-error': videoForm.name.$invalid && !videoForm.name.$pristine, 'has-success': videoForm.name.$valid && !videoForm.name.$pristine }">
                            <input ng-model="videoData.name" type="text" class="form-control" name="name" id="name" placeholder="Name" required ng-minlength="3">
                            <span ng-show="videoForm.name.$invalid && !videoForm.name.$pristine" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                            <span ng-show="videoForm.name.$valid && !videoForm.name.$pristine" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback" ng-class="{ 'has-error': videoForm.description.$invalid && !videoForm.description.$pristine, 'has-success': videoForm.description.$valid && !videoForm.description.$pristine }">
                            <input ng-model="videoData.description" type="text" class="form-control" name="description" id="description" placeholder="Description">
                            <span ng-show="videoForm.description.$invalid && !videoForm.description.$pristine" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                            <span ng-show="videoForm.description.$valid && !videoForm.description.$pristine" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <tags-input name="tags" id="tags" ng-model="videoData.tags">
                                <auto-complete source="loadTags($query)"></auto-complete>
                            </tags-input>
                        </div>
                        <div class="form-group">
                            <button type="submit"
                                    class="btn btn-default text-center"
                                    ng-hide="loading"
                                    ng-disabled="videoForm.$invalid">Submit</button>

                            <div class="spinner" ng-show="loading">
                                <div class="rect1"></div>
                                <div class="rect2"></div>
                                <div class="rect3"></div>
                                <div class="rect4"></div>
                                <div class="rect5"></div>
                            </div>
                        </div>
                    </form>
                    <form class="navbar-form form-inline text-center" role="search">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Search" ng-model="search">
                            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </form>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="thumbnail video text-center" ng-repeat="(index, video) in videos | filter:search" ng-controller="videoCtrl">
                        <a href="//www.youtube.com/watch?v={{video.youtube_id}}" target="_blank">
                            <img ng-src="//img.youtube.com/vi/{{video.youtube_id}}/mqdefault.jpg" alt="{{ video.name }}">
                        </a>
                        <div class="caption">
                            <h4><strong>{{ video.name }}</strong></h4>
                            <p> {{ video.description }}</p>
                        </div>
                        <ul class="video-tags">
                            <li ng-repeat="tag in video.tags">
                                <span class="label label-default label-tag"> {{ tag.text }}</span>
                            </li>
                        </ul>
                        <div class="actions" ng-show="showSettings">
                            <span ng-click="setVideoWatched(index)" class="glyphicon glyphicon-ok video-action" aria-hidden="true"></span>
                            <span ng-click="deleteVideo(index)" class="glyphicon glyphicon-trash video-action" aria-hidden="true"></span>
                        </div>
                        <div class="action-display" ng-click="toggleSettings()">
                            <span class="glyphicon glyphicon-cog video-settings" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
	