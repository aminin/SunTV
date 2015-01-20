<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hello</title>
        link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/legend.css"/>
        <link rel="stylesheet" href="css/smartbox.css"/>
        <link rel="stylesheet" href="css/style.css"/>

        <script type="text/javascript" src="js/src/libs/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="js/src/libs/lodash.compat.min.js"></script>
        <script type="text/javascript" src="js/src/libs/event_emitter.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>

        <script type="text/javascript" src="js/src/sb.js"></script> 
        <script type="text/javascript" src="js/src/sb.platform.js"></script> 

        <script type="text/javascript" src="js/src/platforms/_browser/player.browser.js"></script> 
        <script type="text/javascript" src="js/src/platforms/_browser/sb.platform.browser.js"></script> 
        <script type="text/javascript" src="js/src/platforms/_browser/voicelink.browser.js"></script> 
        
        <script type="text/javascript" src="js/src/platforms/dune/player.dune.js"></script> 
        <script type="text/javascript" src="js/src/platforms/dune/sb.platform.dune.js"></script> 

        <script type="text/javascript" src="js/src/platforms/lg/player.lg.js"></script> 
        <script type="text/javascript" src="js/src/platforms/lg/sb.platform.lg.js"></script> 
        
        <script type="text/javascript" src="js/src/platforms/mag/player.mag.js"></script> 
        <script type="text/javascript" src="js/src/platforms/mag/sb.platform.mag.js"></script> 

        <script type="text/javascript" src="js/src/platforms/philips/player.philips.js"></script> 
        <script type="text/javascript" src="js/src/platforms/philips/sb.platform.philips.js"></script> 

        <script type="text/javascript" src="js/src/platforms/samsung/localstorage.js"></script> 
        <script type="text/javascript" src="js/src/platforms/samsung/player.samsung.js"></script> 
        <script type="text/javascript" src="js/src/platforms/samsung/sb.platform.samsung.js"></script> 
        <script type="text/javascript" src="js/src/platforms/samsung/voicelink.samsung.js"></script> 
        
        <script type="text/javascript" src="js/src/plugins/input.js"></script> 
        <script type="text/javascript" src="js/src/plugins/keyboard.js"></script> 
        <script type="text/javascript" src="js/src/plugins/legend.js"></script> 
        <script type="text/javascript" src="js/src/plugins/log.js"></script> 
        <script type="text/javascript" src="js/src/plugins/nav.js"></script> 
        <script type="text/javascript" src="js/src/plugins/player.js"></script> 
        <script type="text/javascript" src="js/src/plugins/voicelink.js"></script> 
        <script>
        var MoviesProvider = {
            getList:function(filter, cb){
                data = {};
                data.action = [this.requestActions.getCatalog];
                data.genre = [filter.genre] || [0];
                data.offset = [filter.offset] || [0];
                data.size = [filter.size] || [12];
                this.request(data, cb);
            },
            getOne:function(id, cb){
                data = {};
                data.action = [this.requestActions.getOne];
                data.movie_id = [id];
                this.request(data, cb);
            },
            requestParams:{
                type:"POST",
                url:"http://online.scts.tv/api.php?format=ajax",
                contentType:'application/octet-stream; charser=utf-8',
                crossDomain:true,
                data:null,
                success:function(response){}
            },
            requestActions:{
                getCatalog:'video.getCatalog',
                getOne:'videoCustom.getMovie'
            },
            request:function(data, successCb){
                /*data.action
                data.genre
                data.offset
                data.size*/ 
                rp = this.requestParams;
                rp.data = data;
                rp.success = successCb;
                $.ajax(this.requestParams);
            }
        };

        var Controller = {
            showMoviesList:function(genre, offset, limit){
                filter = {};
                filter.genre = genre;
                filter.offset = offset;
                filter.limit = limit;
                MoviesProvider.getList(filter, function(data){
                    console.log(JSON.parse(data.replace(/JsHttpRequest.dataReady\((.+)\)/, '$1')));
                });
            },
            showMovieInfo:function(id){
                MoviesProvider.getOne(id, function(data){
                    console.log(JSON.parse(data.replace(/JsHttpRequest.dataReady\((.+)\)/, '$1')));
                });
            },
            playMovie:function(id){
                MoviesProvider.getOne(id, function(data){
                    Player.play(data.url);    
                });
            },
        };
        $(function(){
            Controller.showMoviesList(0,0,12);
            Controller.showMovieInfo(1);
        });
        </script>
    </head>
    <body>
        <div class="wrap">
            
        </div>
    </body>
</html>