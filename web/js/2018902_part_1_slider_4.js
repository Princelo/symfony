jQuery.bestnwSlider = function(options){

    var opt = options || {};
    var baseUrl = opt.baseUrl || '';
    var mainBody = opt.bigAreaHead || '.product-img-box ';
    var bigAreaHead = opt.bigAreaHead || mainBody + '.media-head ';
    var bigArea = opt.bigArea || bigAreaHead + '.product-image ';
    var bigAreaImg = bigArea + ' img';
    var bigAreaContent=bigAreaHead + ".product-shop ";
    var listArea = opt.listArea || '.product-img-box .more-views';
    var listAreaImg = listArea + ' .move-content li img';
    var hasGallery = opt.hasGallery || 0;
    var hasArrow = opt.hasArrow || 0;
    var speed = opt.speed || 100;
    var autoSpeed = opt.autoSpeed || 3000;
    var barType = opt.barType || 1;
    var timeIntervalId = null;
    if(barType == 2){
        listAreaImg = listArea + ' .move-content li';
    }


    var $bigAreaHead=jQuery(bigAreaHead);
    var $bigArea = jQuery(bigArea);
    var $bigAreaImg = jQuery(bigAreaImg);
    var $bigAreaTitle = jQuery(bigAreaContent + ".product-name span");
    var $bigAreaDes = jQuery(bigAreaContent + ".short-description .std");
    var $listAreaPre = jQuery(listArea + ' div.more-left');
    var $listAreaNext = jQuery(listArea + ' div.more-right');
    var $listAreaContent = jQuery(listArea + ' .move-content');
    var $listAreaItem = jQuery(listArea + ' .move-content ul');
    var $listArea = jQuery(listArea);
    var $listAreaImg = jQuery(listAreaImg);

    var listAreaItemWidth = 0;
    var listAreaPages = 0;

    var nowListAreaItem=0;
    var autoTimeIntervalId = null;
    //Thumbnail Area height and position
    var listAreat=parseInt($listArea.css('top'));
    var listAreah=parseInt($listArea.css('height'));
    var showIntervalId = null;

    //Bigimage
    var bigAreaW=parseInt($bigArea.css('width'));
    var scrollIntervalId = null;

    //left and right
    var rightOrLeft=1;//0-left 1-right
    init();

    function init(){
        if(hasArrow){
            $listAreaPre.show();
            $listAreaNext.show();
        }
        if(hasGallery){
            $bigArea.addClass('gallery-over');
        }

        $listAreaContent.width(jQuery(listArea).width()-$listAreaPre.width()-$listAreaNext.width());
        //$listAreaContent.width('100px');
        var $listAreaFirstItem = jQuery(listArea + ' .move-content li:first');
        var listWidth = 100;
        if(barType == 1){
            listWidth = parseInt($listAreaFirstItem.width()) + parseInt($listAreaFirstItem.css('padding-left')) + parseInt($listAreaFirstItem.css('padding-right'));
            $listAreaItem.width(listWidth * jQuery(listArea + ' .move-content li').length+50);
        }

        listAreaItemWidth = listWidth * (jQuery(listArea + ' .move-content li').length - 1) + $listAreaFirstItem.width();
        listAreaPages = Math.ceil(listAreaItemWidth / $listAreaContent.width());

        jQuery(listAreaImg).eq(0).addClass("imgover");
        
        if(autoSpeed){
            autoTimeIntervalId = setInterval(autoSlider, autoSpeed);
        }

        //init bigimage area left
        jQuery(bigAreaHead).each(function(i){
            jQuery(this).css('left',(i*bigAreaW)+"px");
        });

        jQuery(mainBody).mouseover(function(){
            if(canShow()){
                clearInterval(showIntervalId);
                showIntervalId = setInterval(showListImge, speed/10);
            }
        })
        .mouseleave(function(){
            if(canHidden()){
                clearInterval(showIntervalId);
                showIntervalId = setInterval(hiddenListImge, speed/10);
            }
        });
        jQuery(listAreaImg).each(function(i){
            jQuery(this).mouseover(function(){
                if(nowListAreaItem!=i){
                    jQuery(this).addClass("imgover1");
                    rightOrLeft=0;
                    if(i>nowListAreaItem){
                        rightOrLeft=1;
                    }
                }
            })

            .mouseout(function(){
                if(nowListAreaItem!=i){
                    jQuery(this).removeClass("imgover1");
                    jQuery(this).removeClass("imgover");
                }
            });

            jQuery(this).click(function(){
                var nowImg=jQuery(bigAreaHead).eq(nowListAreaItem);
                if(parseInt(nowImg.css('left'))==0){
                    clearInterval(autoTimeIntervalId);
                    autoTimeIntervalId = setInterval(autoSlider, autoSpeed);
                    canScroll(i,1);
                }

            });
        });

    }
    //imgList show and hide with mouse
    function showListImge(){
        if(canShow()){
        //$listArea.css('top',parseInt($listArea.css('top'))-2);
        }
    }
    function hiddenListImge(){
        if(canHidden()){
            $listArea.css('top',parseInt($listArea.css('top'))+2);
        }
    }
    function canShow(){
        return parseInt($listArea.css('top')) > (listAreat-listAreah);
    }
    function canHidden(){
        return parseInt($listArea.css('top')) < listAreat;
    }
    //bigimage Scroll
    function canScroll(clickindex){
        var nextItem=clickindex;
        var nowImg=jQuery(bigAreaHead).eq(nowListAreaItem);
        var nextImg=jQuery(bigAreaHead).eq(nextItem);

        if(nowListAreaItem!=nextItem && scrollIntervalId==null){
            for(var n=0;n<$listAreaImg.length;n++){
                jQuery(listAreaImg).eq(n).removeClass("imgover1");
                if(clickindex==n){
                    jQuery(listAreaImg).eq(n).addClass("imgover");
                }else{
                    jQuery(listAreaImg).eq(n).removeClass("imgover");
                }
            }

            if(rightOrLeft){
                nextImg.css('left',bigAreaW+'px');
                nowImg.animate({
                    left:-bigAreaW+'px'
                });
                nextImg.animate({
                    left:'0px'
                });
            }else{
                nextImg.css('left',-bigAreaW+'px');
                nowImg.animate({
                    left:bigAreaW+'px'
                });
                nextImg.animate({
                    left:'0px'
                });
            }

            //nowImg.css('left','2px');
            nowListAreaItem=nextItem;
        }

    }



    //left&right arrow
    function forwardPre(){
        if(canPre()){
            $listAreaItem.css('left', parseInt($listAreaItem.css('left'))+2);
        }else{
        //$listAreaPre.removeClass('pre-over');
        }
    }

    function forwardNext(){
        if(canNext()){
            $listAreaItem.css('left', parseInt($listAreaItem.css('left'))-2);
        }else{
        //$listAreaNext.removeClass('next-over');
        }
    }

    function canPre(){
        return parseInt($listAreaItem.css('left')) < 0 ;
    }

    function canNext(){
        return parseInt($listAreaItem.css('left')) + listAreaItemWidth > $listAreaContent.width();
    }
    function autoSlider(){
        var imgCount=$listAreaImg.length;
        var nextItem=nowListAreaItem+1;
        if(nextItem>=imgCount){
            nowListAreaItem=-1;
            nextItem=0
        }
        canScroll(nextItem);

    }
    function nextSlider(){
        var imgCount=$listAreaImg.length;
        var nextItem=nowListAreaItem+1;
        if(nextItem>=imgCount){
            nowListAreaItem=-1;
            nextItem=0;
        }
        rightOrLeft=1;
        jQuery(listAreaImg).eq(nextItem).click();
    }
    function preSlider(){
        var imgCount=$listAreaImg.length;
        var nextItem=nowListAreaItem-1;
        if(nextItem<0){
            nowListAreaItem=0;
            nextItem=imgCount-1;
        }
        rightOrLeft=0;
        jQuery(listAreaImg).eq(nextItem).click();
    }

    if(hasArrow){
        $listAreaPre.mouseover(function(){
            if(canPre() && barType==1 ){
                //jQuery(this).addClass('pre-over');
                timeIntervalId = setInterval(forwardPre, speed);
            }
        })

        .mouseout(function(){
            if(timeIntervalId){
                clearInterval(timeIntervalId);
            //jQuery(this).removeClass('pre-over');
            }
        })

        .click(function(){
            if(canPre()){
                if(Math.ceil(Math.abs(parseInt($listAreaItem.css('left')) /$listAreaContent.width())) <= listAreaPages ){
                    $listAreaItem.css('left' , Math.ceil((parseInt($listAreaItem.css('left')) /$listAreaContent.width())) * $listAreaContent.width() + 'px' );
                }else{
                    $listAreaItem.css('left' , '0px');
                }
            }
            preSlider();
        })
        ;

        $listAreaNext.mouseover(function(){
            if(canNext() && barType==1){
                //jQuery(this).addClass('next-over');
                timeIntervalId = setInterval(forwardNext, speed);
            }
        })

        .mouseout(function(){
            if(timeIntervalId){
                clearInterval(timeIntervalId);
            //jQuery(this).removeClass('next-over');
            }
        })

        .click(function(){
            if(canNext()){
                if(Math.ceil(Math.abs(parseInt($listAreaItem.css('left')) /$listAreaContent.width())) < listAreaPages -1 ){
                    $listAreaItem.css('left' , '-' + (Math.ceil(Math.abs(parseInt($listAreaItem.css('left')) /$listAreaContent.width())) * $listAreaContent.width()) + 'px' );
                }else{
                    $listAreaItem.css('left' , '-' + (listAreaItemWidth - $listAreaContent.width()) + 'px' );
                }
            }
            nextSlider();
        })
    ;
    }


}