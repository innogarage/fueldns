<div class="xfluid">

    <div class="xspan domain-listing" data-width="300">
        <div class="domains-head">
            <div class="btn-group pull-left">
                <button class="btn btn-grey"><i class="icon icon-folder-open"></i> Development</button>
                <button class="btn btn-grey dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="">Developing</a></li>
                    <li><a href="">Production</a></li>
                    <li><a href="">Testing</a></li>
                </ul>
            </div>
            <a href="/domains/add" class="btn btn-grey pull-right"><i class="icon icon-plus"></i></a>
            <div class="clearfix"></div>
        </div>
        <div class="xspan-inner">

            <div class="domain-search">
                <form class="form form-inline" action="">
                    <input type="text" class="search-query input-block-level" placeholder="Quick search...">
                </form>
            </div>

            <ul class="domain-listing-nav">
                <?php foreach($domains as $_domain) { ?>
                <li<? if ($_domain->id == @$domain->id) { ?> class="active"<? } ?>><a href="/domains/records/<?= $_domain->id; ?>"><i class="icon icon-globe"></i> <?= $_domain->name; ?><span>on</span></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="xspan domain-records" data-width="extend-right">