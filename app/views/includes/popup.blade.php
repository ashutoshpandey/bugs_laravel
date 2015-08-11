<!-- modal content -->
<div id="popup_status">
    Change bug status <br/><br/>

    <label><input type="radio" name="bug_status" value="fixed" checked="checked">Fixed</label><br/>
    <label><input type="radio" name="bug_status" value="unresolved">Unresolved</label><br/><br/>

    <input type="button" name="btn-change-status" value="Change Status"/> &nbsp;
    <input type="button" name="btn-cancel-status" value="Cancel"/>
    <br/><br/>
</div>

<!-- preload the images -->
<div style='display:none'>
    {{HTML::image(asset("public/images/logo.png", ''))}}
</div>
{{HTML::script(asset("/public/js/jquery.simplemodal.js"))}}
