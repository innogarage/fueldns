
        <div class="domains-head">
            <a class="btn btn-danger pull-right"><i class="icon-white icon-remove"></i> Remove Domain</a>
            <a class="btn btn-success pull-left" style="margin-right:10px"><i class="icon-white icon-plus"></i> Add Record</a>
            <div class="btn-group pull-left" style="margin-right:10px">
                <a class="btn"><i class="icon icon-edit"></i> Edit</a>
                <a class="btn"><i class="icon icon-folder-open"></i> Group</a>
                <a class="btn" href="/domains/export/<?= $domain->id; ?>"><i class="icon icon-share-alt"></i> Export</a>
            </div>
            <div class="clearfix"></div>

            <h1 class="lead"><?= $domain->name; ?></h1>


            <div class="domain-records-contact"><i class="icon icon-envelope"></i> hostmaster@<?= $domain->name; ?>&nbsp;&nbsp;&nbsp;<i class="icon icon-repeat"></i> 5 min</div>

        </div>

        <div class="xspan-inner">
            <div class="domain-records-table">
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th style="padding-left: 15px;">Name</th>
                            <th>Type</th>
                            <th>Content</th>
                            <th>TTL</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($records as $record) { ?>
                        <tr>
                            <td style="padding-left: 15px;"><?= $record->name; ?></td>
                            <td><?= $record->type; ?></td>
                            <td><?= $record->content; ?></td>
                            <td><?= $record->ttl; ?></td>
                            <td><?= $record->prio; ?></td>
                            <td style="padding-right: 15px;text-align: right">
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
    </div>

    <div class="clearfix"></div>

</div>