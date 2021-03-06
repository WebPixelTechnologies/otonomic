
var mainCarousel = ' <!-- Indicators -->\
<ol class="carousel-indicators">\
    {#apps}\
          <li data-target="#appmarket-carousel" data-slide-to="{$idx}" {@if cond="{$idx} == 0"}class="active"{/if}></li>\
    {/apps}\
</ol>\
<!-- Wrapper for slides -->
<div class="carousel-inner">\
    {#apps}\
  <div class="item {@if cond="{$idx} == 0"}active{/if} js-carousel-item">\
    <img class="js-carousel-image" src="{sliderImage}" alt="{sliderAlt}">\
    <div class="carousel-caption js-carousel-caption">\
      <div class="media">\
          <h1 class="media-heading">{name}</h1>\
          <img class="pull-left media-object" src="{thumbnail}" alt="{alt}">\
          <div class="media-body">{decription}</div>\
          <a href="#">Learn more</a>\
      </div>\
      <div class="pull-left">\
          <div class="oto-app-count"><span class="glyphicons user_add"></span>{numAdded} Added this App</div>\
      </div>\
      <div class="pull-right text-right">\
          <button type="button" class="btn btn-link btn-price"><b>{price}</b> /{plan}</button>\
          <a href="{buyBtnLink}{id}" class="btn btn-oto-orange js-oto-app-fade-out"><span class="glyphicons shopping_cart"></span> Add app</a>\
      </div>\
    </div>\
  </div>\
  {/apps}\
</div>\
<!-- Controls -->\
<a class="left carousel-control" href="#appmarket-carousel" role="button" data-slide="prev">\
    <span class="glyphicon glyphicon-chevron-left"></span>\
</a>\
<a class="right carousel-control" href="#appmarket-carousel" role="button" data-slide="next">\
    <span class="glyphicon glyphicon-chevron-right"></span>\
</a>';

var appBox ='{#apps}\
<div class="col-xs-12 col-md-4 oto-app-holder">\
  <div class="thumbnail oto-app js-oto-app-fade-in" data-app-id="{id}">\
      <div class="layer-1">\
          <img src="{thumbnail}" alt="{alt}">\
          <div class="caption line-clamp">\
              <h4>{name}</h4>\
          </div>\
          <div class="oto-app-count"><span class="glyphicons user_add"></span>{numAdded} Added this App</div>\
      </div>\
      <div class="layer-2">\
          <div class="caption line-clamp">\
              <h4>{name}</h4>\
          </div>\
          <p class="price-tag"><b>{price}</b> /{plan}</p>\
          <p>{decription}<br><a href="#">Learn more</a></p>\
          <a href="{buyBtnLink}{id}" class="btn btn-oto-orange btn-cornered"><span class="glyphicons shopping_cart"></span> Add app</a>\
      </div>\
  </div>\
</div>\
{/apps}';


var appPage = '{#apps}\
  {@eq key=\"{id}\" value=\"{currentApp}\"}\
<div class="row">\
  <div class="col-xs-12"><h3 class="app-name">{name}</h3></div>\
    <div class="col-md-6">\
        <div class="oto-app-count"><span class="glyphicons user_add"></span>{numAdded} Added this App</div>\
    </div>\
    <div class="col-md-6 text-right">\
        <button type="button" class="btn btn-link btn-price" data-toggle="tooltip" data-placement="top" title="{tooltip}"><b>{price}</b> /{plan}</button>\
        <a href="{buyBtnLink}{id}" class="btn btn-oto-orange js-oto-app-fade-out"><span class="glyphicons shopping_cart"></span> Add app</a>\
    </div>\
</div>\
<!-- Carousel  -->\
<div id="app-carousel" class="carousel slide" data-ride="carousel">\
    <!-- Indicators -->\
    <ol class="carousel-indicators">\
        {#images}\
                <li data-target="#app-carousel" data-slide-to="{$idx}" {@if cond="{$idx} == 0"}class="active"{/if}></li>\
        {/images}\
    </ol>\
    <!-- Wrapper for slides -->\
    <div class="carousel-inner">\
          {#images}\
          <div class="item {@if cond="{$idx} == 0"}active{/if}">\
            <img src="{src}" alt="{alt}">\
          </div>\
          {/images}\
    </div>\
    <!-- Controls -->\
      <a class="left carousel-control" href="#app-carousel" role="button" data-slide="prev">\
        <span class="glyphicon glyphicon-chevron-left"></span>\
      </a>\
      <a class="right carousel-control" href="#app-carousel" role="button" data-slide="next">\
        <span class="glyphicon glyphicon-chevron-right"></span>\
      </a>\
</div>\
<!-- END Carousel  -->\
<div class="app-decription">{decription}</div>\
<div class="row">\
    <div class="col-md-6">\
        <div class="oto-app-count"><span class="glyphicons user_add"></span>{numAdded} Added this App</div>\
    </div>\
    <div class="col-md-6 text-right">\
        <button type="button" class="btn btn-link btn-price" data-toggle="tooltip" data-placement="top" title="{tooltip}"><b>{price}</b> /{plan}</button>\
        <a href="{buyBtnLink}{id}" class="btn btn-oto-orange js-oto-app-fade-out"><span class="glyphicons shopping_cart"></span> Add app</a>\
    </div>\
</div>\
{/eq}\
{/apps}';