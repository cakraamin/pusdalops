<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="keywords" content="jquery,ui,easy,easyui,web">
  <meta name="description" content="easyui help you build your web page easily!">  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/fingers/components/datagrid/easyui.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/fingers/components/datagrid/icon.css">  
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/fingers/components/datagrid/jquery-1.6.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/fingers/components/datagrid/jquery.easyui.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/fingers/components/datagrid/jquery.edatagrid.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/fingers/components/lightbox/facebox.js"></script>
  <script type="text/javascript">
    var products = [
        {productid:'FI-SW-01',name:'Meinggal Dunia'},
        {productid:'K9-DL-01',name:'Hilang'},
        {productid:'RP-SN-01',name:'Luka Ringan'},
        {productid:'RP-LI-02',name:'Luka Berat'},
        {productid:'FL-DSH-01',name:'Pengungsi'},
        {productid:'FL-DLH-02',name:'Menderita'},
        {productid:'AV-CB-01',name:'Kerusakan'}
    ];

    $(function(){
      $('#dg').edatagrid({
        url: 'get_user',
        saveUrl: 'save_user',
        updateUrl: 'update_user',
        destroyUrl: 'destroy_user'
      });
    });
  </script>
  <style type="text/css">
  #kolomnya{    
    margin: 3px;
  }
  </style>
</head>
<body>
  <div id="kolomnya">
    <h2>UPDATE DATA KORBAN</h2>
    <div class="demo-info" style="margin-bottom:10px">
      <div class="demo-tip icon-tip">&nbsp;</div>      
    </div>
    
    <table id="dg" title="Korban Bencana" style="width:700px;height:250px"
        toolbar="#toolbar" pagination="true" idField="id"
        rownumbers="true" fitColumns="true" singleSelect="true">
      <thead>
        <tr>
          <th field="firstname" width="50" editor="{type:'validatebox',options:{required:true}}">First Name</th>
          <th field="lastname" width="50" editor="{type:'validatebox',options:{required:true}}">Last Name</th>
          <th field="phone" width="50" editor="{type:'combobox',options:{valueField:'productid',textField:'name',data:products,required:true}}">Phone</th>
          <th field="email" width="50" editor="{type:'validatebox',options:{validType:'email'}}">Email</th>
        </tr>
      </thead>
    </table>
    <div id="toolbar">
      <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
      <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
      <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
      <a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
    </div>
    <span><a href="javascript:void(0)" onClick="jQuery.facebox.close();">Keluar</a></span>
  </div>
</body>
</html>