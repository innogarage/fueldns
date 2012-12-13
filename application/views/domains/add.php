<div style="margin:50px">
<form class="form-horizontal">
    <fieldset>
        <legend>Create new domain zone</legend>
        <div class="control-group">
            <label class="control-label" for="domain_name">Domain name</label>
            <div class="controls">
                <input type="text" id="domain_name" name="domain_name" placeholder="example.com">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="domain_email">Hostmaster email</label>
            <div class="controls">
                <input type="text" id="domain_email" name="domain_email" placeholder="hostmaster@example.com">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="domain_ttl">TTL (seconds)</label>
            <div class="controls">
                <input type="text" id="domain_ttl" name="domain_ttl" placeholder="300">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="domain_group">Group</label>
            <div class="controls">
                <select id="domain_group" name="domain_group">
                    <option selected="selected">general</option>
                    <option>development</option>
                    <option>production</option>
                    <option>testing</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn">Create</button>
            </div>
        </div>
    </fieldset>
</form>
</div>