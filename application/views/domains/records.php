<div class="xfluid">

    <div class="xspan domain-listing" data-width="300">
        <div class="domains-head">
            <h1 class="lead pull-left">Adult</h1>
            <a class="btn btn-success pull-right"><i class="icon-white icon-plus"></i> New</a>
            <div class="clearfix"></div>
        </div>
        <div class="xspan-inner">
            <ul class="domain-listing-nav">
                <?php foreach($domains as $_domain) { ?>
                <li<? if ($_domain->id == $domain->id) { ?> class="active"<? } ?>><a href="/domains/records/<?= $_domain->id; ?>"><?= $_domain->name; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="xspan domain-records" data-width="extend-right">
        <div class="domains-head">
        <h1 class="lead pull-left"><?= $domain->name; ?></h1>
            <a class="btn btn-danger pull-right"><i class="icon-white icon-remove"></i> Remove Domain</a>
            <a class="btn btn-success pull-right" style="margin-right:10px"><i class="icon-white icon-plus"></i> Add Record</a>
            <div class="btn-group pull-right" style="margin-right:10px">
                <a class="btn"><i class="icon icon-edit"></i> Edit</a>
                <a class="btn"><i class="icon icon-globe"></i> Group</a>
            </div>
        </div>
        <div class="xspan-inner">

        <table class="table table-hover table-striped table-condensed">
            <thead>
                <tr>
                    <th style="padding-left: 20px;">Name</th>
                    <th>Type</th>
                    <th>Content</th>
                    <th>TTL</th>
                    <th>Priority</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($records as $record) { ?>
                <tr>
                    <td style="padding-left: 20px;"><?= $record->name; ?></td>
                    <td><?= $record->type; ?></td>
                    <td><?= $record->content; ?></td>
                    <td><?= $record->ttl; ?></td>
                    <td><?= $record->prio; ?></td>
                    <td style="padding-right: 20px;text-align: right">
                        <div class="btn-group">
                            <a class="btn btn-mini"><i class="icon icon-edit"></i> </a>
                            <a class="btn btn-mini"><i class="icon icon-remove"></i> </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>

    <div class="clearfix"></div>

</div>