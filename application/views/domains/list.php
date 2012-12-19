<div class="xfluid">

    <div class="xspan domain-listing" data-width="300">
        <div class="domains-head">
            <div class="btn-group pull-left">
                <button class="btn btn-grey"><i class="icon icon-folder-open"></i> <span style="display:inline-block;max-width: 140px;overflow: hidden"><?= isset($groups[$gid]->name) ? $groups[$this->input->get("gid")]->name : "All domains" ?></span></button>
                <button class="btn btn-grey dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="?gid=0">All domains</a></li>
                    <? foreach($groups as $group) { ?>
                    <li<? if ($this->input->get("gid") == $group->id) { ?> class="active"<? } ?>><a href="?gid=<?= $group->id; ?>"><?= $group->name; ?></a></li>
                    <? } ?>
                </ul>
            </div>
            <a href="/domains/add?gid=<?= $gid; ?>" class="btn btn-grey pull-right"><i class="icon icon-plus"></i></a>
            <div class="clearfix"></div>
        </div>
        <div class="xspan-inner">

            <div class="domain-search">
                <form class="form form-inline" action="">
                    <input type="text" class="search-query input-block-level" placeholder="Quick search...">
                </form>
            </div>

            <ul class="domain-listing-nav">
                <?php if ($domains) { foreach($domains as $_domain) { ?>
                <li<? if ($_domain->id == @$domain->id) { ?> class="active"<? } ?>><a href="/domains/records/<?= $_domain->id; ?>?gid=<?= $gid; ?>"><i class="icon icon-globe"></i> <?= $_domain->name; ?><span>on</span></a></li>
                <?php } } else { ?>
                <div class="no_result">
                    <h2 class="lead">Opps!</h2>
                    <p>No domains found in this group.<br /></p>
                    <a href="/domains/add?gid=<?= $gid; ?>" class="btn"><i class="icon icon-plus"></i> Add Domain</a>
                </div>
                <? } ?>
            </ul>
        </div>
    </div>

    <div class="xspan domain-records" data-width="extend-right">