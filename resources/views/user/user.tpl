{include file="common/header.tpl"}
{if count($users) > 0 }
<table class="table">
    <caption>用户</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Pwd</th>
    </tr>
    </thead>
    <tbody>
    {foreach $users as $user}
    <tr>
        <td>{$user.user_id}</td>
        <td>{$user.user_name}</td>
        <td>{$user.password}</td>
    </tr>
    {/foreach}
    </tbody>
</table>
    {$pagination}
{else}
    no data
{/if}

{include file="common/footer.tpl"}
