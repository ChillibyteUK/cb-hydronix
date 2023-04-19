<section class="cbsearch py-5 bg--grey">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-4 d-flex align-items-center">
                <div class="h2 my-2"><?=__('Find your material','cb-hydronix')?></div>
            </div>
            <div class="col-md-8">
                <form id="search" class="d-flex" action="/" method="get" accept-charset="utf-8">
                    <input type="text" name="s" id="search-s" value="" class="form-control" />
                    <button type="submit" class="btn btn-primary"><?=__('Search','cb-hydronix')?></button>
                    <input type="hidden" name="post_type" value="products,pages" />
                </form>
            </div>
        </div>
    </div>
</section>