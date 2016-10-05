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
<table id="membersList">

</table>

<form id="addMember" style="display: none;">
	<p>
		<label>用户昵称:</label>
		<input type="text" name="name" class="easyui-validatebox" id="name">
	</p>
	<p>
		<label>用户密码:</label>
		<input type="password" name="password"  class="easyui-validatebox">
	</p>
	<p>
		<label>用户邮箱:</label>
		<input type="text" name="email" class="easyui-validatebox">
	</p>
	<p>
		<label>用户Q Q:</label>
		<input type="text" name="qq"  class="easyui-validatebox">
	</p>
	<p>
		<label><span style="vertical-align: 37px;">用户头像:</span></label>
		<img src="/Public/Admin/images//small_face.jpg" id="face" alt="默认头像" style="cursor: pointer;" onclick="alert('upload');"/>
	</p>
</form>

<!-- edit members -->
<form id="editMember" style="display: none;" class="easyui-d">
	<p>
		<label>用户昵称:</label>
		<input type="hidden" value="" name="edit_id"/>
		<input type="text" name="edit_name" class="easyui-validatebox" id="edit_name" disabled="disabled">
	</p>
	<p>
		<label>用户密码:</label>
		<input type="hidden" name="edit_pass" id="edit_pass" value="">
		<input type="password" name="edit_password"  class="easyui-validatebox" placeholder="密码留空则不修改" value=''>
	</p>
	<p>
		<label>用户邮箱:</label>
		<input type="text" name="edit_email" class="easyui-validatebox">
	</p>
	<p>
		<label>用户Q Q:</label>
		<input type="text" name="edit_qq"  class="easyui-validatebox">
	</p>
	<p>
		<label><span style="vertical-align: 37px;">用户头像:</span></label>
		<img src="/Public/Admin/images//small_face.jpg" id="face" alt="默认头像" style="cursor: pointer;" onclick="alert('upload');"/>
	</p>
</form>
<script type="text/javascript" src="/Public/Admin/jquery_easyui//members.js"></script>