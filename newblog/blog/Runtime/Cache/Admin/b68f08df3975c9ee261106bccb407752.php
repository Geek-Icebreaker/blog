<?php if (!defined('THINK_PATH')) exit();?>
<div id="article-toolbar">
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload',plain:true" onclick="tools.reload();">刷新</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-cancel',plain:true" onclick="tools.delete();">删除</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-redo',plain:true" onclick="tools.undo();">撤销</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok',plain:true" onclick="tools.checkAll();">勾选所有</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add-new',plain:true" onclick="tools.add();">添加</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-user-edit',plain:true" onclick="tools.edit();">编辑</a>	
	<div style="padding: 5px 0;border-top:solid 1px #DDDDDD">
		标题查询：<input type="text" class="easyui-textbox" value="" name="username"/>
		创建时间从：<input type="text" class="easyui-datebox" name="timeFrom"/>
		到:<input  type="text" class="easyui-datebox" name="timeTo"/>
		<a href="javascript:void(0);" class="easyui-linkbutton" onclick="tools.search();">查询</a>
	</div>	
</div>
<table id="articleList">

</table>

<!--添加文章-->

<form action="###" id="addArticle" style="display: none;">
	<div class="article-div">	
			<div><h3>文章标题</h3></div>
			<input class="easyui-validatebox textbox" style="width:60%;height:32px" name="title">
	</div>
	<div class="article-div">
		<div><h3>文章简介</h3></div>
		<input class="easyui-validatebox textbox" style="width:50%;height:52px" name="intro">
	</div>
	<div class="article-div">
		<div><h3>文章分类</h3></div>
		<select id="cate" name="cate" class="easyui-combobox" style="width:150px;">
			<option value="请选择文章分类">请选择文章分类</option>
		</select>
	</div>

	<div class="article-div">
		<div><h3>文章发布者</h3></div>
		<select id="author" name="author" class="easyui-combobox" style="width:150px;">
			<option value="请选择发布者">请选择发布者</option>
		</select>
	</div class="article-div">
	<div class="article-div">
		<div><h3>发布时间</h3></div>
		<input id="dt" type="text" name="create-time" style="width: 150px;">
	</div>
	
	<div class="article-div">
		<div><h3>正文内容</h3></div>
		<textarea name="editor" id="editor" rows="10" cols="80">
           
        </textarea>
	</div>	
</form>

<!--编辑文章-->
<form action="###" id="editArticle" style="display: none;">
	<div class="article-div">	
			<div><h3>文章标题</h3></div>
			<input type="hidden" value="" name="e_id"/>
			<input class="easyui-validatebox textbox" style="width:60%;height:32px" name="e_title">
		</div>
	<div class="article-div">
		<div><h3>文章分类</h3></div>
		<select id="e-cate" name="e_cate" class="easyui-combobox" style="width:150px;">
			<option value="请选择文章分类">请选择文章分类</option>
		</select>
	</div>
	<div class="article-div">
		<div><h3>文章简介</h3></div>
		<input class="easyui-validatebox textbox" style="width:50%;height:52px" name="e_intro">
	</div>
	<div class="article-div">
		<div><h3>文章发布者</h3></div>
		<select id="e-author" name="e_author" class="easyui-combobox" style="width:150px;">
			<option value="请选择发布者">请选择发布者</option>
		</select>
	</div>

	<div class="article-div">
		<div><h3>发布时间</h3></div>
		<input id="e-dt" type="text" name="e_create_time" style="width: 150px;">
	</div>
	
	<div class="article-div">
		<div><h3>正文内容</h3></div>
		<textarea name="e-editor" id="e_editor" rows="10" cols="80">
           
        </textarea>
	</div>
</form>

	<script type="text/javascript" src="/Public/Admin/jquery_easyui//article.js"></script>