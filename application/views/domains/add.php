<div style="margin:50px">

    <h2 class="lead">Create new domain zone</h2>

    <form class="form-horizontal" method="post">
        <fieldset>
            <? if (($ve = validation_errors()) || ($ve = @$errors)) { ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $ve; ?>
            </div>
            <? } ?>
            <div class="control-group">
                <label class="control-label" for="<?= $form['domain_name']['id'] ?>"><?= $form['domain_name']['label'] ?></label>
                <div class="controls">
                    <input type="text" id="<?= $form['domain_name']['id'] ?>" name="<?= $form['domain_name']['name'] ?>" value="<?= $form['domain_name']['value'] ?>" placeholder="<?= $form['domain_name']['placeholder'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="<?= $form['domain_email']['id'] ?>"><?= $form['domain_email']['label'] ?></label>
                <div class="controls">
                    <input type="text" id="<?= $form['domain_email']['id'] ?>" name="<?= $form['domain_email']['name'] ?>" value="<?= $form['domain_email']['value'] ?>" placeholder="<?= $form['domain_email']['placeholder'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="<?= $form['domain_ttl']['id'] ?>"><?= $form['domain_ttl']['label'] ?></label>
                <div class="controls">
                    <input type="text" id="<?= $form['domain_ttl']['id'] ?>" name="<?= $form['domain_ttl']['name'] ?>" value="<?= $form['domain_ttl']['value'] ?>" placeholder="<?= $form['domain_ttl']['placeholder'] ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="domain_group">Group</label>
                <div class="controls">

                    <div id="domain_group_select">
                        <div class="btn-group">
                            <a class="btn" id="domain_group_add"><i class="icon icon-plus"></i></a>
                            <a class="btn select-label" data-toggle="dropdown"><i class="icon icon-folder-open"></i> <span><?= isset($form['domain_group']['options'][$form['domain_group']['value']]['name']) ? $form['domain_group']['options'][$form['domain_group']['value']]['name'] : "choose..." ?></span></a>
                            <a class="btn dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu select-input" data-select-id="domain_group">
                                <? foreach($form['domain_group']['options'] as $option) { ?>
                                <li><a data-select-value="<?= $option['id']; ?>"><?= $option['name']; ?></a></li>
                                <? } ?>
                            </ul>

                            <input type="hidden" name="domain_group" id="domain_group" value="<?= isset($form['domain_group']['options'][$form['domain_group']['value']]['id']) ? $form['domain_group']['options'][$form['domain_group']['value']]['id'] : "" ?>" />
                        </div>
                    </div>

                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-success">Create Domain</button>
                </div>
            </div>
        </fieldset>
    </form>

</div>