
<div class="row-fluid">
    <div class="span3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>domain</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($domains as $domain) { ?>
                <tr>
                    <td><?= $domain->id; ?></td>
                    <td><a href="/domains/records/<?= $domain->id; ?>"><?= $domain->name; ?></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="span9">

        Domain details

    </div>

</div>