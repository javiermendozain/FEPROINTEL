<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/pgsql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/detail_page.php';
    include_once dirname(__FILE__) . '/' . 'components/page/nested_form_page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class public_asignar_proyecto_docentePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."asignar_proyecto_docente"');
            $field = new IntegerField('id_adinacion', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('id_evaluador');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_proyecto');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('estado');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('id_evaluador', 'public.evaluadores', new StringField('id_evaluador'), new StringField('nombre_eva', 'id_evaluador_nombre_eva', 'id_evaluador_nombre_eva_public_evaluadores'), 'id_evaluador_nombre_eva_public_evaluadores');
            $this->dataset->AddLookupField('id_proyecto', 'public.proyectos', new IntegerField('id_proyecto', null, null, true), new StringField('nombre_proyecto', 'id_proyecto_nombre_proyecto', 'id_proyecto_nombre_proyecto_public_proyectos'), 'id_proyecto_nombre_proyecto_public_proyectos');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id_adinacion', 'id_adinacion', 'Id Adinacion'),
                new FilterColumn($this->dataset, 'id_evaluador', 'id_evaluador_nombre_eva', 'Evaluador'),
                new FilterColumn($this->dataset, 'id_proyecto', 'id_proyecto_nombre_proyecto', 'Proyecto'),
                new FilterColumn($this->dataset, 'estado', 'estado', 'Estado')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id_adinacion'])
                ->addColumn($columns['id_evaluador'])
                ->addColumn($columns['id_proyecto'])
                ->addColumn($columns['estado']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('id_evaluador')
                ->setOptionsFor('id_proyecto');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for id_evaluador field
            //
            $editor = new AutocompleteComboBox('id_evaluador_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."evaluadores"');
            $field = new StringField('id_evaluador');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_eva');
            $lookupDataset->AddField($field, false);
            $field = new StringField('password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_eva', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Evaluador', 'id_evaluador', 'id_evaluador_nombre_eva', 'edit_id_evaluador_nombre_eva_search', $editor, $this->dataset, $lookupDataset, 'id_evaluador', 'nombre_eva', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_proyecto field
            //
            $editor = new AutocompleteComboBox('id_proyecto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."proyectos"');
            $field = new IntegerField('id_proyecto', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_proyecto');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_publicacion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_categoria');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_video');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_anexos');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_feria');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_user');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_proyecto', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Proyecto', 'id_proyecto', 'id_proyecto_nombre_proyecto', 'edit_id_proyecto_nombre_proyecto_search', $editor, $this->dataset, $lookupDataset, 'id_proyecto', 'nombre_proyecto', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for id_evaluador field
            //
            $editor = new AutocompleteComboBox('id_evaluador_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."evaluadores"');
            $field = new StringField('id_evaluador');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_eva');
            $lookupDataset->AddField($field, false);
            $field = new StringField('password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_eva', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Evaluador', 'id_evaluador', 'id_evaluador_nombre_eva', 'insert_id_evaluador_nombre_eva_search', $editor, $this->dataset, $lookupDataset, 'id_evaluador', 'nombre_eva', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_proyecto field
            //
            $editor = new AutocompleteComboBox('id_proyecto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."proyectos"');
            $field = new IntegerField('id_proyecto', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_proyecto');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_publicacion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_categoria');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_video');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_anexos');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_feria');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_user');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_proyecto', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Proyecto', 'id_proyecto', 'id_proyecto_nombre_proyecto', 'insert_id_proyecto_nombre_proyecto_search', $editor, $this->dataset, $lookupDataset, 'id_proyecto', 'nombre_proyecto', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id_adinacion field
            //
            $column = new NumberViewColumn('id_adinacion', 'id_adinacion', 'Id Adinacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for estado field
            //
            $column = new NumberViewColumn('estado', 'estado', 'Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id_adinacion field
            //
            $column = new NumberViewColumn('id_adinacion', 'id_adinacion', 'Id Adinacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for estado field
            //
            $column = new NumberViewColumn('estado', 'estado', 'Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for estado field
            //
            $column = new NumberViewColumn('estado', 'estado', 'Estado', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        
        public function GetEnableModalGridInsert() { return true; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setExportListAvailable(array('excel','word','xml','csv','pdf'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('excel','word','xml','csv','pdf'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."evaluadores"');
            $field = new StringField('id_evaluador');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_eva');
            $lookupDataset->AddField($field, false);
            $field = new StringField('password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_eva', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_id_evaluador_nombre_eva_search', 'id_evaluador', 'nombre_eva', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."proyectos"');
            $field = new IntegerField('id_proyecto', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_proyecto');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_publicacion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_categoria');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_video');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_anexos');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_feria');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_user');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_proyecto', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_id_proyecto_nombre_proyecto_search', 'id_proyecto', 'nombre_proyecto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."evaluadores"');
            $field = new StringField('id_evaluador');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_eva');
            $lookupDataset->AddField($field, false);
            $field = new StringField('password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_eva', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_id_evaluador_nombre_eva_search', 'id_evaluador', 'nombre_eva', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."proyectos"');
            $field = new IntegerField('id_proyecto', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('nombre_proyecto');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_publicacion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_categoria');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_video');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url_anexos');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_feria');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('id_user');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_proyecto', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_id_proyecto_nombre_proyecto_search', 'id_proyecto', 'nombre_proyecto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, &$cancel, &$message, &$messageDisplayTime, $tableName)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, &$rowData, &$cancel, &$message, &$messageDisplayTime, $tableName)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, &$cancel, &$message, &$messageDisplayTime, $tableName)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doGetCustomUploadFileName($fieldName, $rowData, &$result, &$handled, $originalFileName, $originalFileExtension, $fileSize)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new public_asignar_proyecto_docentePage("public_asignar_proyecto_docente", "asignar_proyecto_docente.php", GetCurrentUserPermissionSetForDataSource("public.asignar_proyecto_docente"), 'UTF-8');
        $Page->SetTitle('Asignar Proyecto Docente');
        $Page->SetMenuLabel('Asignar Proyecto ');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("public.asignar_proyecto_docente"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
