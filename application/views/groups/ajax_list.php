    <div class="btn-group">
        <a class="btn" id="domain_group_add"><i class="icon icon-plus"></i></a>
        <a class="btn select-label" data-toggle="dropdown"><i class="icon icon-folder-open"></i> <span><?= isset($form['domain_group']['options'][$form['domain_group']['value']]['name']) ? $form['domain_group']['options'][$form['domain_group']['value']]['name'] : "choose..." ?></span></a>
        <a class="btn dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu select-input" data-select-id="domain_group">
            <? foreach($form['domain_group']['options'] as $option) { ?>
            <li><a<? if ($option['id'] == $form['domain_group']['value']) { ?> selected="selected"<? } ?> data-select-value="<?= $option['id']; ?>"><?= $option['name']; ?></a></li>
            <? } ?>
        </ul>
        <input type="hidden" name="domain_group" id="domain_group" value="<?= isset($form['domain_group']['options'][$form['domain_group']['value']]['id']) ? $form['domain_group']['options'][$form['domain_group']['value']]['id'] : "" ?>" />
    </div>