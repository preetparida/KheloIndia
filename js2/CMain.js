function CMain(oData){
    
	var _bUpdate;
	
    var _iCurResource = 0;
    var RESOURCE_TO_LOAD = 0;
    var _iState = 0;//STATE_LOADING;
    
    var _oData;
    var _oPreloader;
    var _oMenu;
    var _oHelp;
    var _oGame;

    this.initContainer = function(){
		var canvas = document.getElementById("canvas");
        s_oStage = new createjs.Stage(canvas);       
        createjs.Touch.enable(s_oStage);
        
        s_bMobile = jQuery.browser.mobile;
        if(s_bMobile === false){
            s_oStage.enableMouseOver(20);  
        }
		
        s_iPrevTime = new Date().getTime();

		
        createjs.Ticker.setFPS(30);
        createjs.Ticker.addEventListener("tick", this._update);
		
        if(navigator.userAgent.match(/Windows Phone/i)){
                DISABLE_SOUND_MOBILE = true;
        }
	
		
        s_oSpriteLibrary  = new CSpriteLibrary();
		
        //ADD PRELOADER
        _oPreloader = new CPreloader();
		this._loadImages();
    };

    this.soundLoaded = function(){
         _iCurResource++;
         
         
         if(_iCurResource === RESOURCE_TO_LOAD){
            _oPreloader.unload();
            
            this.gotoMenu();
         }
    };
    
    this._initSounds = function(){/*
        var aSoundsInfo = new Array();
        aSoundsInfo.push({path: './sounds/',filename:'chip',loop:false,volume:1, ingamename: 'chip'});
        aSoundsInfo.push({path: './sounds/',filename:'click',loop:false,volume:1, ingamename: 'click'});
        aSoundsInfo.push({path: './sounds/',filename:'fiche_collect',loop:false,volume:1, ingamename: 'fiche_collect'});
        aSoundsInfo.push({path: './sounds/',filename:'wheel_sound',loop:true,volume:1, ingamename: 'wheel_sound'});
        aSoundsInfo.push({path: './sounds/',filename:'win',loop:false,volume:1, ingamename: 'win'});
        aSoundsInfo.push({path: './sounds/',filename:'lose',loop:false,volume:1, ingamename: 'lose'});
        aSoundsInfo.push({path: './sounds/',filename:'20_placeBetSnd',loop:false,volume:1, ingamename: '20_placeBetSnd'});
        aSoundsInfo.push({path: './sounds/',filename:'22_nomorebetSnd',loop:false,volume:1, ingamename: '22_nomorebetSnd'});
        
        RESOURCE_TO_LOAD += aSoundsInfo.length;

        s_aSounds = new Array();
        for(var i=0; i<aSoundsInfo.length; i++){
            s_aSounds[aSoundsInfo[i].ingamename] = new Howl({ 
                                                            src: [aSoundsInfo[i].path+aSoundsInfo[i].filename+'.mp3', aSoundsInfo[i].path+aSoundsInfo[i].filename+'.ogg'],
                                                            autoplay: false,
                                                            preload: true,
                                                            loop: aSoundsInfo[i].loop, 
                                                            volume: aSoundsInfo[i].volume,
                                                            onload: s_oMain.soundLoaded()
                                                        });
        }
        
        */
    };  
    
    this._loadImages = function(){
        s_oSpriteLibrary.init( this._onImagesLoaded,this._onAllImagesLoaded, this );

		s_oSpriteLibrary.addSprite("bg_menu","./sprites/lobby.png");
        s_oSpriteLibrary.addSprite("but_play","./sprites/but_play.png");
		s_oSpriteLibrary.addSprite("but_fullscreen","./sprites/but_fullscreen.png");
		s_oSpriteLibrary.addSprite("but_exit","./sprites/but_exit.png");
        s_oSpriteLibrary.addSprite("audio_icon","./sprites/audio_icon.png");
		s_oSpriteLibrary.addSprite("but_credits","./sprites/but_credits.png");
		s_oSpriteLibrary.addSprite("single_decker","./sprites/single.png");
		s_oSpriteLibrary.addSprite("double_decker","./sprites/double.png");
		s_oSpriteLibrary.addSprite("triple_decker","./sprites/triple.png");
        
        
        
        RESOURCE_TO_LOAD += s_oSpriteLibrary.getNumSprites();
        
        s_oSpriteLibrary.loadSprites();
		
    };
    
    this._onImagesLoaded = function(){
        _iCurResource++;

        var iPerc = Math.floor(_iCurResource/RESOURCE_TO_LOAD *100);

        //_oPreloader.refreshLoader(iPerc);
        
        if(_iCurResource === RESOURCE_TO_LOAD ){
        	
            _oPreloader.unload();
            
            this.gotoMenu();
        }
        
    };
    
    this._onAllImagesLoaded = function(){
        
    };
    
    this.onImageLoadError = function(szText){
        
    };
	
    this.preloaderReady = function(){
        this._loadImages();
		
	if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            this._initSounds();
        }
        
        _bUpdate = true;
    };
    
    this.gotoMenu = function(){
        _oMenu = new CMenu();
        _iState = STATE_MENU;
		//s_oMain.gotoGame();		
        //$(s_oMain).trigger("start_session");
    };
    
    this.gotoGame = function(){
		//_oGame = new CGame(_oData);   			
        //_iState = STATE_GAME;
    };
    
    this.gotoHelp = function(){
        //_oHelp = new CHelp();
        //_iState = STATE_HELP;
    };
    
    this.stopUpdate = function(){/*
    	alert("preet");
        _bUpdate = false;
        createjs.Ticker.paused = true;
        $("#block_game").css("display","block");
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            Howler.mute(true);
        }
        */
    };

    this.startUpdate = function(){
        s_iPrevTime = new Date().getTime();
        _bUpdate = true;
        createjs.Ticker.paused = false;
        $("#block_game").css("display","none");
        
        if(DISABLE_SOUND_MOBILE === false || s_bMobile === false){
            if(s_bAudioActive){
                Howler.mute(false);
            }
        }
        
    };
    
    this._update = function(event){
        if(_bUpdate === false){
                return;
        }
        var iCurTime = new Date().getTime();
        s_iTimeElaps = iCurTime - s_iPrevTime;
        s_iCntTime += s_iTimeElaps;
        s_iCntFps++;
        s_iPrevTime = iCurTime;
        
        if ( s_iCntTime >= 1000 ){
            s_iCurFps = s_iCntFps;
            s_iCntTime-=1000;
            s_iCntFps = 0;
        }
                
        if(_iState === STATE_GAME){
            _oGame.update();
        }
        
        s_oStage.update(event);

    };
    
    s_oMain = this;
    _oData = oData;
    ENABLE_FULLSCREEN = oData.fullscreen;
    ENABLE_CHECK_ORIENTATION = oData.check_orientation;
    SHOW_CREDITS = _oData.show_credits;

    this.initContainer();
}

var s_bMobile;
var s_bAudioActive = true;
var s_bFullscreen = false;
var s_iCntTime = 0;
var s_iTimeElaps = 0;
var s_iPrevTime = 0;
var s_iCntFps = 0;
var s_iCurFps = 0;

var s_oDrawLayer;
var s_oStage;
var s_oMain = null;
var s_oSpriteLibrary;
var s_aSounds;