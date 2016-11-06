{capture assign="kennismakingsgesprek_button"}{strip}
    <li class="crm-odoo-action crm-contact-kennismakingsgesprek">
        <a href="{$link_to_kennismakingsgesprek}" class="kennismakingsgesprek button" title="View in Odoo">
            <span>{ts}Voer een kennismakingsgesprek in{/ts}</span>
        </a>
    </li>
{/strip}{/capture}


<script type="text/javascript">
    {literal}
    cj(function() {
        cj('li.crm-summary-block').after('{/literal}{$kennismakingsgesprek_button}{literal}');
    });
    {/literal}
</script>