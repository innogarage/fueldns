
        <div class="domains-head">

            <form class="form-inline pull-right" style="margin:0 0 0 10px" method="post" action="/domains/remove"><input type="hidden" id="remove_domain_id" name="remove_domain_id" value="<?= $domain->id; ?>"><button type="submit" class="btn btn-danger pull-right confirm" data-confirm="Delete <?= $domain->name; ?> domain?"><i class="icon-white icon-remove"></i> <span>Delete domain</span></button></form>

            <a class="btn btn-success pull-left" data-toggle="button" id="add_record" style="margin-right:10px"><i class="icon-white icon-plus"></i> Add Record</a>

            <div class="btn-group pull-left" style="margin-right:10px">
                <a class="btn" href="/domains/edit/<?= $domain->id; ?>"><i class="icon icon-edit"></i> Edit</a>
                <a class="btn" href="/domains/export/<?= $domain->id; ?>"><i class="icon icon-share-alt"></i> Export</a>
            </div>

            <div id="domain_group_select" class="pull-left">
                <div class="btn-group">
                    <a class="btn" id="domain_group_add"><i class="icon icon-plus"></i></a>
                    <a class="btn select-label" data-toggle="dropdown"><i class="icon icon-folder-open"></i> <span><?= isset($groups[$domain->group_id]->name) ? $groups[$domain->group_id]->name : "General" ?></span></a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu select-input" data-select-id="domain_group">
                        <? foreach($groups as $option) { ?>
                        <li><a data-select-value="<?= $option->id; ?>"><?= $option->name; ?></a></li>
                        <? } ?>
                    </ul>

                    <input type="hidden" name="domain_group" id="domain_group" value="<?= isset($groups[$domain->group_id]->name) ? $groups[$domain->group_id]->id : "" ?>" />
                </div>
            </div>

            <div class="clearfix"></div>

            <h1 class="lead"><?= $domain->name; ?></h1>

            <div class="domain-records-contact">
                <span rel="tooltip" title="Hostmaster email"><i class="icon icon-envelope"></i> <?= $soa["email"]; ?></span>
                <span rel="tooltip" title="TTL (Time to Live)"><i class="icon icon-repeat"></i> <?= $soa["ttl"] / 60; ?> min</span>
                <span rel="tooltip" title="Serial Number"><i class="icon icon-asterisk"></i> <?= $soa["serial"]; ?></span>
                <span rel="tooltip" title="Last domain update"><i class="icon icon-time"></i> <?= $soa["change_date"]; ?></span>
            </div>

        </div>

        <div class="xspan-inner">
            <div class="domain-records-table">
                <table class="table table-condensed">
                    <tbody>
                        <tr id="add_record_block">
                            <td style="padding-left:15px">
                                <div class="input-prepend input-append" id="ar_name_block" style="margin: 0px">
                                    <div class="control-group" style="margin: 0px">
                                        <div class="btn-group pull-left">
                                            <button class="btn select-label"><span>Type</span></button>
                                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu select-input" data-select-id="ar_type">
                                                <li><a data-select-value="A">A</a></li>
                                                <li><a data-select-value="CNAME">CNAME</a></li>
                                                <li><a data-select-value="MX">MX</a></li>
                                                <li><a data-select-value="NS">NS</a></li>
                                                <li><a data-select-value="TXT">TXT</a></li>
                                            </ul>
                                            <input type="hidden" name="ar_type" id="ar_type" value="" />
                                        </div>
                                    <input type="text" id="ar_name" placeholder="name" style="margin: 0px" />
                                    <input type="hidden" id="ar_did" value="<?= $domain->id; ?>" />
                                    <span id="ar_name_append" rel="<?= $domain->name; ?>" class="add-on" style="margin: 0px">.<?= $domain->name; ?></span>
                                    </div>
                                </div>
                                <span id="ar_name_mask" class="input-block-level uneditable-input" style="margin: 0px;display: none"><?= $domain->name; ?></span>
                            </td>
                            <td><div class="control-group" style="margin: 0px"><input type="text" class="input-block-level" id="ar_content" placeholder="content" style="margin: 0px" /></div></td>
                            <td><div class="control-group" style="margin: 0px"><input type="text" class="input-block-level" id="ar_ttl" placeholder="ttl" style="margin: 0px" /></div></td>
                            <td><div class="control-group" style="margin: 0px"><input type="text" class="input-block-level" id="ar_priority" placeholder="priority" style="margin: 0px" /></div></td>
                            <td style="padding-right: 15px;text-align: right">
                                <a class="btn btn-success" id="ar_submit"><i class="icon icon-plus icon-white"></i> Add</a>
                            </td>
                        </tr>

                        <?php foreach($grecords as $type => $records) { ?>

                        <tr style="">
                            <td colspan="5" style="background: #e7e6e6;color:#444;"><div style="padding-left: 10px;font-size:14px;"><b><?= $type; ?> Records</b></div></td>
                        </tr>

                        <tr class="record_type">
                            <th><div style="padding-left: 10px">Hostname</div></th>
                            <th>
                                <? if ($type == "A") { ?>IP Adrress<? } ?>
                                <? if ($type == "CNAME") { ?>Target Domain<? } ?>
                                <? if ($type == "MX") { ?>Mailserver Domain<? } ?>
                                <? if ($type == "NS") { ?>Name Server<? } ?>
                                <? if ($type == "TXT") { ?>Text<? } ?>
                            </th>
                            <th>TTL</th>
                            <th><? if ($type == "MX") { ?>Priority<? } ?></th>
                            <th style="text-align: right;padding-right: 15px;">Actions</th>
                        </tr>

                        <? foreach($records as $record) { ?>
                        <form method="post" class="record_row_form">
                            <input type="hidden" id="er_domain_id" name="er_domain_id" value="<?= $domain->id; ?>" />
                            <input type="hidden" id="er_record_id" name="er_record_id" value="<?= $record->id; ?>" />
                        <tr class="record_row record_edit" rel="<?= $record->id; ?>" width="100%">
                            <td width="35%">
                                <div style="padding-left: 10px">
                                <? if ($type == "NS") { ?>
                                <div class="er_group er_content" style="margin: 0px">
                                    <span class="er_vals"><?= $record->name; ?></span>
                                </div>
                                <? } else { ?>
                                <div class="er_group er_group_addon er_input" style="margin: 0px">
                                    <input class="er_input" name="er_name" id="er_name" type="text" value="<?= substr(str_replace($domain->name, "", $record->name),0,-1); ?>" style="margin: 0px" />
                                    <span class="er_input_addon" style="margin: 0px;">.<?= $domain->name; ?></span>
                                </div>
                                <span class="er_val"><?= $record->name; ?></span>
                                <? } ?>
                                </div>
                            </td>
                            <td width="35%">
                                <div class="er_group er_content" style="margin: 0px">
                                    <input class="er_input" name="er_content" id="er_content" style="width:90%" type="text" value="<?= $record->content; ?>">
                                    <span class="er_val"><?= $record->content; ?></span>
                                </div>
                            </td>
                            <td width="10%">
                                <div class="er_group er_ttl" style="margin: 0px">
                                    <input class="er_input" name="er_ttl" id="er_ttl" style="width:90%" type="text" value="<?= $record->ttl; ?>">
                                    <span class="er_val"><?= $record->ttl; ?></span>
                                </div>
                            </td>
                            <td width="10%">
                                <div class="er_group er_prio" style="margin: 0px">
                                    <? if ($type == "MX") { ?>
                                    <input class="er_input" name="er_prio" id="er_prio" style="width:90%" type="text" value="<?= $record->prio; ?>">
                                    <span class="er_val"><?= $record->prio; ?></span>
                                    <? } ?>
                                </div>
                            </td>
                            <td width="10%" style="text-align: right">
                                <div style="padding-right: 10px">
                                <button type="submit" rel="<?= $record->id; ?>" class="btn btn-mini btn-success record_save_btn"><i class="icon icon-ok icon-white"></i></button>
                                <button type="button" rel="<?= $record->id; ?>" class="btn btn-mini record_edit_btn"><i class="icon icon-edit"></i></button>
                                <button type="button" rel="<?= $record->id; ?>" class="btn btn-mini btn-danger record_remove"><i class="icon icon-remove icon-white"></i></button>
                                </div>
                            </td>
                        </tr>
                        </form>
                        <?php } ?>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</div>