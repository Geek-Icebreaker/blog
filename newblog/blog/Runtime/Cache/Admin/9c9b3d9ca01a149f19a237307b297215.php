<?php if (!defined('THINK_PATH')) exit();?><div id="toolbar">
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload',plain:true" onclick="tools.reload();">刷新</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="tools.delete();">删除</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="tools.undo();">撤销</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="tools.checkAll();">勾选所有</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add-new',plain:true" onclick="tools.add();">添加</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-user-edit',plain:true" onclick="tools.edit();">编辑</a>	
	<div style="margin: 5px 0;">
		查询账号：<input type="text" class="easyui-textbox" value="" name="username"/>
		创建时间从：<input type="text" class="easyui-datebox" name="timeFrom"/>
		到:<input  type="text" class="easyui-datebox" name="timeTo"/>
		<a href="javascript:void(0);" class="easyui-linkbutton" onclick="tools.search();">查询</a>
	</div>	
</div>
<table id="linkList">

</table>
<form id="addLinks" style="display:none;">
	<p>
		<label for="name">名称：</label>
		<input class="easyui-validatebox" type="text" name="a_name" id="a_name" style="width:150px"/>
	</p>
	<p>
		<label for="url">地址：</label>
		<input class="easyui-validatebox" type="text" name="a_url" id="a_url" style="width:200px"/>
	</p>
	<p>
		<label for="date">日期：</label>
		<input name="a_date" id="a_date" style="width:150px" >
	</p>
</form>

<form id="editLinks" style="display:none;">
	<p>
		<label for="name">名称：</label>
		<input type="hidden" type="text" id="e_id" name="e_id"/>
		<input type="text" name="e_name" id="e_name" style="width:150px"/>
	</p>
	<p>
		<label for="url">地址：</label>
		<input type="text" name="e_url" id="e_url" style="width:200px"/>
	</p>
	<p>
		<label for="date">日期：</label>
		<input type="text" name="e_date" value="" id="e_date" style="width:150px">
	</p>
	<!--<p>
		<label for="date">状态：</label>
		<input name="e_status" id="e_status" style="width:150px">
	</p>-->

</form>


<script type="text/javascript" src="/Public/Admin/jquery_easyui//links.js"></script>