{if isset($confirmation)}
    <div class="alert alert-success">Settings updated</div>
{/if}

<fieldset>
	<h2>Telegram Alert configuration</h2>
	<div class="panel">
		<div class="panel-heading">
			<legend><img src="../img/admin/cog.gif" alt="" width="16" />Configuration</legend>
		</div>
		<form action="" method="post">

			<div class="form-group clearfix">
				<label class="col-lg-3">Enter Telegram Bot Id:</label>
				<div class="col-lg-9">
					<input type="input" id="bot_id_1" name="bot_id" value="{$bot_id}" />
				</div>
			</div>

			<div class="form-group clearfix">
				<label class="col-lg-3">Enter Chat Id of group:</label>
				<div class="col-lg-9">
					<input type="input" id="chat_id_1" name="chat_id" value="{$chat_id}" />
				</div>
			</div>


			<div class="form-group clearfix">
				<label class="col-lg-3">Enable New Order Alert:</label>
				<div class="col-lg-9">
					<img src="../img/admin/enabled.gif" alt="" />
					<input type="radio" id="enable_orders_1" name="enable_orders" value="1" {if $enable_orders eq '1'}checked{/if} />
					<label class="t" for="enable_orders_1">Yes</label>
                    <img src="../img/admin/disabled.gif" alt="" />
					<input type="radio" id="enable_orders_0" name="enable_orders" value="0" {if empty($enable_orders) || $enable_orders eq '0'}checked{/if} />
					<label class="t" for="enable_orders_0">No</label>
				</div>
			</div>

			<div class="panel-footer">
				<input class="btn btn-default pull-right" type="submit" name="mymod_pc_form" value="Save" />
			</div>
		</form>
	</div>
</fieldset>
