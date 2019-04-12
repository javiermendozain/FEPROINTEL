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
    
    
    
    class public_proyectos_public_evaluacionPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."evaluacion"');
            $field = new IntegerField('presentacion');
            $this->dataset->AddField($field, false);
            $field = new StringField('id_evaluador');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_proyecto');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_evaluacion', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('tiempo');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('coherencia_met');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('claridad');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('diapositiva');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('video');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('conclusiones');
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
                new FilterColumn($this->dataset, 'presentacion', 'presentacion', 'Presentacion'),
                new FilterColumn($this->dataset, 'id_evaluador', 'id_evaluador_nombre_eva', 'Id Evaluador'),
                new FilterColumn($this->dataset, 'id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto'),
                new FilterColumn($this->dataset, 'id_evaluacion', 'id_evaluacion', 'Id Evaluacion'),
                new FilterColumn($this->dataset, 'tiempo', 'tiempo', 'Tiempo'),
                new FilterColumn($this->dataset, 'coherencia_met', 'coherencia_met', 'Coherencia Met'),
                new FilterColumn($this->dataset, 'claridad', 'claridad', 'Claridad'),
                new FilterColumn($this->dataset, 'diapositiva', 'diapositiva', 'Diapositiva'),
                new FilterColumn($this->dataset, 'video', 'video', 'Video'),
                new FilterColumn($this->dataset, 'conclusiones', 'conclusiones', 'Conclusiones')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['presentacion'])
                ->addColumn($columns['id_evaluador'])
                ->addColumn($columns['id_proyecto'])
                ->addColumn($columns['id_evaluacion'])
                ->addColumn($columns['tiempo'])
                ->addColumn($columns['coherencia_met'])
                ->addColumn($columns['claridad'])
                ->addColumn($columns['diapositiva'])
                ->addColumn($columns['video'])
                ->addColumn($columns['conclusiones']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('id_evaluador')
                ->setOptionsFor('id_proyecto');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('presentacion_edit');
            
            $filterBuilder->addColumn(
                $columns['presentacion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new AutocompleteComboBox('id_evaluador_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_id_evaluador_nombre_eva_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('id_evaluador', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_id_evaluador_nombre_eva_search');
            
            $text_editor = new TextEdit('id_evaluador');
            
            $filterBuilder->addColumn(
                $columns['id_evaluador'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new AutocompleteComboBox('id_proyecto_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_id_proyecto_nombre_proyecto_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('id_proyecto', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_id_proyecto_nombre_proyecto_search');
            
            $text_editor = new TextEdit('id_proyecto');
            
            $filterBuilder->addColumn(
                $columns['id_proyecto'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('id_evaluacion_edit');
            
            $filterBuilder->addColumn(
                $columns['id_evaluacion'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('tiempo_edit');
            
            $filterBuilder->addColumn(
                $columns['tiempo'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('coherencia_met_edit');
            
            $filterBuilder->addColumn(
                $columns['coherencia_met'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('claridad_edit');
            
            $filterBuilder->addColumn(
                $columns['claridad'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('diapositiva_edit');
            
            $filterBuilder->addColumn(
                $columns['diapositiva'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('video_edit');
            
            $filterBuilder->addColumn(
                $columns['video'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('conclusiones_edit');
            
            $filterBuilder->addColumn(
                $columns['conclusiones'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
    
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for presentacion field
            //
            $column = new NumberViewColumn('presentacion', 'presentacion', 'Presentacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Id Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for id_evaluacion field
            //
            $column = new NumberViewColumn('id_evaluacion', 'id_evaluacion', 'Id Evaluacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tiempo field
            //
            $column = new NumberViewColumn('tiempo', 'tiempo', 'Tiempo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for coherencia_met field
            //
            $column = new NumberViewColumn('coherencia_met', 'coherencia_met', 'Coherencia Met', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for claridad field
            //
            $column = new NumberViewColumn('claridad', 'claridad', 'Claridad', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for diapositiva field
            //
            $column = new NumberViewColumn('diapositiva', 'diapositiva', 'Diapositiva', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for video field
            //
            $column = new NumberViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for conclusiones field
            //
            $column = new NumberViewColumn('conclusiones', 'conclusiones', 'Conclusiones', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for presentacion field
            //
            $column = new NumberViewColumn('presentacion', 'presentacion', 'Presentacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Id Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for id_evaluacion field
            //
            $column = new NumberViewColumn('id_evaluacion', 'id_evaluacion', 'Id Evaluacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tiempo field
            //
            $column = new NumberViewColumn('tiempo', 'tiempo', 'Tiempo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for coherencia_met field
            //
            $column = new NumberViewColumn('coherencia_met', 'coherencia_met', 'Coherencia Met', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for claridad field
            //
            $column = new NumberViewColumn('claridad', 'claridad', 'Claridad', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for diapositiva field
            //
            $column = new NumberViewColumn('diapositiva', 'diapositiva', 'Diapositiva', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for video field
            //
            $column = new NumberViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for conclusiones field
            //
            $column = new NumberViewColumn('conclusiones', 'conclusiones', 'Conclusiones', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for presentacion field
            //
            $editor = new TextEdit('presentacion_edit');
            $editColumn = new CustomEditColumn('Presentacion', 'presentacion', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Id Evaluador', 'id_evaluador', 'id_evaluador_nombre_eva', 'edit_id_evaluador_nombre_eva_search', $editor, $this->dataset, $lookupDataset, 'id_evaluador', 'nombre_eva', '');
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
            $editColumn = new DynamicLookupEditColumn('Id Proyecto', 'id_proyecto', 'id_proyecto_nombre_proyecto', 'edit_id_proyecto_nombre_proyecto_search', $editor, $this->dataset, $lookupDataset, 'id_proyecto', 'nombre_proyecto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_evaluacion field
            //
            $editor = new TextEdit('id_evaluacion_edit');
            $editColumn = new CustomEditColumn('Id Evaluacion', 'id_evaluacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tiempo field
            //
            $editor = new TextEdit('tiempo_edit');
            $editColumn = new CustomEditColumn('Tiempo', 'tiempo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for coherencia_met field
            //
            $editor = new TextEdit('coherencia_met_edit');
            $editColumn = new CustomEditColumn('Coherencia Met', 'coherencia_met', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for claridad field
            //
            $editor = new TextEdit('claridad_edit');
            $editColumn = new CustomEditColumn('Claridad', 'claridad', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for diapositiva field
            //
            $editor = new TextEdit('diapositiva_edit');
            $editColumn = new CustomEditColumn('Diapositiva', 'diapositiva', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for video field
            //
            $editor = new TextEdit('video_edit');
            $editColumn = new CustomEditColumn('Video', 'video', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for conclusiones field
            //
            $editor = new TextEdit('conclusiones_edit');
            $editColumn = new CustomEditColumn('Conclusiones', 'conclusiones', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for presentacion field
            //
            $editor = new TextEdit('presentacion_edit');
            $editColumn = new CustomEditColumn('Presentacion', 'presentacion', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Id Evaluador', 'id_evaluador', 'id_evaluador_nombre_eva', 'insert_id_evaluador_nombre_eva_search', $editor, $this->dataset, $lookupDataset, 'id_evaluador', 'nombre_eva', '');
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
            $editColumn = new DynamicLookupEditColumn('Id Proyecto', 'id_proyecto', 'id_proyecto_nombre_proyecto', 'insert_id_proyecto_nombre_proyecto_search', $editor, $this->dataset, $lookupDataset, 'id_proyecto', 'nombre_proyecto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_evaluacion field
            //
            $editor = new TextEdit('id_evaluacion_edit');
            $editColumn = new CustomEditColumn('Id Evaluacion', 'id_evaluacion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tiempo field
            //
            $editor = new TextEdit('tiempo_edit');
            $editColumn = new CustomEditColumn('Tiempo', 'tiempo', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for coherencia_met field
            //
            $editor = new TextEdit('coherencia_met_edit');
            $editColumn = new CustomEditColumn('Coherencia Met', 'coherencia_met', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for claridad field
            //
            $editor = new TextEdit('claridad_edit');
            $editColumn = new CustomEditColumn('Claridad', 'claridad', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for diapositiva field
            //
            $editor = new TextEdit('diapositiva_edit');
            $editColumn = new CustomEditColumn('Diapositiva', 'diapositiva', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for video field
            //
            $editor = new TextEdit('video_edit');
            $editColumn = new CustomEditColumn('Video', 'video', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for conclusiones field
            //
            $editor = new TextEdit('conclusiones_edit');
            $editColumn = new CustomEditColumn('Conclusiones', 'conclusiones', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for presentacion field
            //
            $column = new NumberViewColumn('presentacion', 'presentacion', 'Presentacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Id Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for id_evaluacion field
            //
            $column = new NumberViewColumn('id_evaluacion', 'id_evaluacion', 'Id Evaluacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for tiempo field
            //
            $column = new NumberViewColumn('tiempo', 'tiempo', 'Tiempo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for coherencia_met field
            //
            $column = new NumberViewColumn('coherencia_met', 'coherencia_met', 'Coherencia Met', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for claridad field
            //
            $column = new NumberViewColumn('claridad', 'claridad', 'Claridad', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for diapositiva field
            //
            $column = new NumberViewColumn('diapositiva', 'diapositiva', 'Diapositiva', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for video field
            //
            $column = new NumberViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for conclusiones field
            //
            $column = new NumberViewColumn('conclusiones', 'conclusiones', 'Conclusiones', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for presentacion field
            //
            $column = new NumberViewColumn('presentacion', 'presentacion', 'Presentacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Id Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for id_evaluacion field
            //
            $column = new NumberViewColumn('id_evaluacion', 'id_evaluacion', 'Id Evaluacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for tiempo field
            //
            $column = new NumberViewColumn('tiempo', 'tiempo', 'Tiempo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for coherencia_met field
            //
            $column = new NumberViewColumn('coherencia_met', 'coherencia_met', 'Coherencia Met', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for claridad field
            //
            $column = new NumberViewColumn('claridad', 'claridad', 'Claridad', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for diapositiva field
            //
            $column = new NumberViewColumn('diapositiva', 'diapositiva', 'Diapositiva', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for video field
            //
            $column = new NumberViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for conclusiones field
            //
            $column = new NumberViewColumn('conclusiones', 'conclusiones', 'Conclusiones', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for presentacion field
            //
            $column = new NumberViewColumn('presentacion', 'presentacion', 'Presentacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for nombre_eva field
            //
            $column = new TextViewColumn('id_evaluador', 'id_evaluador_nombre_eva', 'Id Evaluador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for id_evaluacion field
            //
            $column = new NumberViewColumn('id_evaluacion', 'id_evaluacion', 'Id Evaluacion', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for tiempo field
            //
            $column = new NumberViewColumn('tiempo', 'tiempo', 'Tiempo', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for coherencia_met field
            //
            $column = new NumberViewColumn('coherencia_met', 'coherencia_met', 'Coherencia Met', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for claridad field
            //
            $column = new NumberViewColumn('claridad', 'claridad', 'Claridad', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for diapositiva field
            //
            $column = new NumberViewColumn('diapositiva', 'diapositiva', 'Diapositiva', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for video field
            //
            $column = new NumberViewColumn('video', 'video', 'Video', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for conclusiones field
            //
            $column = new NumberViewColumn('conclusiones', 'conclusiones', 'Conclusiones', $this->dataset);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_id_evaluador_nombre_eva_search', 'id_evaluador', 'nombre_eva', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_id_proyecto_nombre_proyecto_search', 'id_proyecto', 'nombre_proyecto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
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
    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class public_proyectos_public_ganadores_feriaPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."ganadores_feria"');
            $field = new IntegerField('id_proyecto');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('id_puestos');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $this->dataset->AddLookupField('id_proyecto', 'public.proyectos', new IntegerField('id_proyecto', null, null, true), new StringField('nombre_proyecto', 'id_proyecto_nombre_proyecto', 'id_proyecto_nombre_proyecto_public_proyectos'), 'id_proyecto_nombre_proyecto_public_proyectos');
            $this->dataset->AddLookupField('id_puestos', 'public.puestos', new IntegerField('id_puestos', null, null, true), new StringField('puesto', 'id_puestos_puesto', 'id_puestos_puesto_public_puestos'), 'id_puestos_puesto_public_puestos');
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
                new FilterColumn($this->dataset, 'id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto'),
                new FilterColumn($this->dataset, 'id_puestos', 'id_puestos_puesto', 'Id Puestos')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id_proyecto'])
                ->addColumn($columns['id_puestos']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('id_proyecto')
                ->setOptionsFor('id_puestos');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new AutocompleteComboBox('id_proyecto_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_id_proyecto_nombre_proyecto_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('id_proyecto', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_id_proyecto_nombre_proyecto_search');
            
            $text_editor = new TextEdit('id_proyecto');
            
            $filterBuilder->addColumn(
                $columns['id_proyecto'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new AutocompleteComboBox('id_puestos_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_id_puestos_puesto_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('id_puestos', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_id_puestos_puesto_search');
            
            $text_editor = new TextEdit('id_puestos');
            
            $filterBuilder->addColumn(
                $columns['id_puestos'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
    
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for puesto field
            //
            $column = new TextViewColumn('id_puestos', 'id_puestos_puesto', 'Id Puestos', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for puesto field
            //
            $column = new TextViewColumn('id_puestos', 'id_puestos_puesto', 'Id Puestos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
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
            $editColumn = new DynamicLookupEditColumn('Id Proyecto', 'id_proyecto', 'id_proyecto_nombre_proyecto', 'edit_id_proyecto_nombre_proyecto_search', $editor, $this->dataset, $lookupDataset, 'id_proyecto', 'nombre_proyecto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_puestos field
            //
            $editor = new AutocompleteComboBox('id_puestos_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."puestos"');
            $field = new IntegerField('id_puestos', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('puesto');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('puesto', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Id Puestos', 'id_puestos', 'id_puestos_puesto', 'edit_id_puestos_puesto_search', $editor, $this->dataset, $lookupDataset, 'id_puestos', 'puesto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
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
            $editColumn = new DynamicLookupEditColumn('Id Proyecto', 'id_proyecto', 'id_proyecto_nombre_proyecto', 'insert_id_proyecto_nombre_proyecto_search', $editor, $this->dataset, $lookupDataset, 'id_proyecto', 'nombre_proyecto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_puestos field
            //
            $editor = new AutocompleteComboBox('id_puestos_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."puestos"');
            $field = new IntegerField('id_puestos', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('puesto');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('puesto', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Id Puestos', 'id_puestos', 'id_puestos_puesto', 'insert_id_puestos_puesto_search', $editor, $this->dataset, $lookupDataset, 'id_puestos', 'puesto', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for puesto field
            //
            $column = new TextViewColumn('id_puestos', 'id_puestos_puesto', 'Id Puestos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for puesto field
            //
            $column = new TextViewColumn('id_puestos', 'id_puestos_puesto', 'Id Puestos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('id_proyecto', 'id_proyecto_nombre_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for puesto field
            //
            $column = new TextViewColumn('id_puestos', 'id_puestos_puesto', 'Id Puestos', $this->dataset);
            $column->SetOrderable(true);
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
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."puestos"');
            $field = new IntegerField('id_puestos', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('puesto');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('puesto', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_id_puestos_puesto_search', 'id_puestos', 'puesto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
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
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_id_proyecto_nombre_proyecto_search', 'id_proyecto', 'nombre_proyecto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."puestos"');
            $field = new IntegerField('id_puestos', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('puesto');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('puesto', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_id_puestos_puesto_search', 'id_puestos', 'puesto', null, 20);
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
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."puestos"');
            $field = new IntegerField('id_puestos', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('puesto');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('puesto', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_id_puestos_puesto_search', 'id_puestos', 'puesto', null, 20);
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
    
    // OnBeforePageExecute event handler
    
    
    
    class public_proyectosPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."proyectos"');
            $field = new IntegerField('id_proyecto', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('nombre_proyecto');
            $this->dataset->AddField($field, false);
            $field = new StringField('descripcion');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('fecha_publicacion');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_categoria');
            $this->dataset->AddField($field, false);
            $field = new StringField('url_doc');
            $this->dataset->AddField($field, false);
            $field = new StringField('url_video');
            $this->dataset->AddField($field, false);
            $field = new StringField('url_anexos');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_feria');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('id_user');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('id_feria', 'public.ferias', new IntegerField('id_feria', null, null, true), new StringField('nombre_feria', 'id_feria_nombre_feria', 'id_feria_nombre_feria_public_ferias'), 'id_feria_nombre_feria_public_ferias');
            $this->dataset->AddLookupField('id_categoria', 'public.categoria', new IntegerField('id_categoria', null, null, true), new StringField('descripcion', 'id_categoria_descripcion', 'id_categoria_descripcion_public_categoria'), 'id_categoria_descripcion_public_categoria');
            $this->dataset->AddLookupField('id_user', 'public.user_student', new IntegerField('id_user'), new StringField('user_nombres', 'id_user_user_nombres', 'id_user_user_nombres_public_user_student'), 'id_user_user_nombres_public_user_student');
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
                new FilterColumn($this->dataset, 'id_proyecto', 'id_proyecto', 'Id Proyecto'),
                new FilterColumn($this->dataset, 'nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto'),
                new FilterColumn($this->dataset, 'descripcion', 'descripcion', 'Descripción'),
                new FilterColumn($this->dataset, 'fecha_publicacion', 'fecha_publicacion', 'Fecha Presentación'),
                new FilterColumn($this->dataset, 'id_feria', 'id_feria_nombre_feria', 'Feria'),
                new FilterColumn($this->dataset, 'id_categoria', 'id_categoria_descripcion', 'Categoría'),
                new FilterColumn($this->dataset, 'url_doc', 'url_doc', 'Cargar Documento'),
                new FilterColumn($this->dataset, 'url_video', 'url_video', 'URL Video'),
                new FilterColumn($this->dataset, 'url_anexos', 'url_anexos', 'Cargar Anexos'),
                new FilterColumn($this->dataset, 'id_user', 'id_user_user_nombres', 'Id User')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id_proyecto'])
                ->addColumn($columns['nombre_proyecto'])
                ->addColumn($columns['descripcion'])
                ->addColumn($columns['fecha_publicacion'])
                ->addColumn($columns['id_feria'])
                ->addColumn($columns['id_categoria'])
                ->addColumn($columns['url_doc'])
                ->addColumn($columns['url_video'])
                ->addColumn($columns['url_anexos'])
                ->addColumn($columns['id_user']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('fecha_publicacion')
                ->setOptionsFor('id_feria')
                ->setOptionsFor('id_categoria')
                ->setOptionsFor('id_user');
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
            if (GetCurrentUserPermissionSetForDataSource('public.proyectos.public.evaluacion')->HasViewGrant() && $withDetails)
            {
            //
            // View column for public_proyectos_public_evaluacion detail
            //
            $column = new DetailColumn(array('id_proyecto'), 'public.proyectos.public.evaluacion', 'public_proyectos_public_evaluacion_handler', $this->dataset, 'Evaluacion');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionSetForDataSource('public.proyectos.public.ganadores_feria')->HasViewGrant() && $withDetails)
            {
            //
            // View column for public_proyectos_public_ganadores_feria detail
            //
            $column = new DetailColumn(array('id_proyecto'), 'public.proyectos.public.ganadores_feria', 'public_proyectos_public_ganadores_feria_handler', $this->dataset, 'Ganadores Feria');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for id_proyecto field
            //
            $column = new NumberViewColumn('id_proyecto', 'id_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(100);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_nombre_proyecto_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(250);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_descripcion_handler_list');
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha_publicacion field
            //
            $column = new DateTimeViewColumn('fecha_publicacion', 'fecha_publicacion', 'Fecha Presentación', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d ');
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nombre_feria field
            //
            $column = new TextViewColumn('id_feria', 'id_feria_nombre_feria', 'Feria', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('id_categoria', 'id_categoria_descripcion', 'Categoría', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for url_doc field
            //
            $column = new TextViewColumn('url_doc', 'url_doc', 'Cargar Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(50);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_url_video_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for url_anexos field
            //
            $column = new TextViewColumn('url_anexos', 'url_anexos', 'Cargar Anexos', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for user_nombres field
            //
            $column = new TextViewColumn('id_user', 'id_user_user_nombres', 'Id User', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id_proyecto field
            //
            $column = new NumberViewColumn('id_proyecto', 'id_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(100);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_nombre_proyecto_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(250);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_descripcion_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fecha_publicacion field
            //
            $column = new DateTimeViewColumn('fecha_publicacion', 'fecha_publicacion', 'Fecha Presentación', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d ');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombre_feria field
            //
            $column = new TextViewColumn('id_feria', 'id_feria_nombre_feria', 'Feria', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('id_categoria', 'id_categoria_descripcion', 'Categoría', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for url_doc field
            //
            $column = new TextViewColumn('url_doc', 'url_doc', 'Cargar Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(50);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_url_video_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for url_anexos field
            //
            $column = new TextViewColumn('url_anexos', 'url_anexos', 'Cargar Anexos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for user_nombres field
            //
            $column = new TextViewColumn('id_user', 'id_user_user_nombres', 'Id User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for nombre_proyecto field
            //
            $editor = new TextEdit('nombre_proyecto_edit');
            $editColumn = new CustomEditColumn('Nombre Proyecto', 'nombre_proyecto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for descripcion field
            //
            $editor = new HtmlWysiwygEditor('descripcion_edit');
            $editColumn = new CustomEditColumn('Descripción', 'descripcion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fecha_publicacion field
            //
            $editor = new DateTimeEdit('fecha_publicacion_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Presentación', 'fecha_publicacion', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_feria field
            //
            $editor = new AutocompleteComboBox('id_feria_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."ferias"');
            $field = new IntegerField('id_feria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new DateTimeField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('periodo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombre_feria');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_feria', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Feria', 'id_feria', 'id_feria_nombre_feria', 'edit_id_feria_nombre_feria_search', $editor, $this->dataset, $lookupDataset, 'id_feria', 'nombre_feria', '%nombre_feria% - %fecha% - %periodo%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_categoria field
            //
            $editor = new AutocompleteComboBox('id_categoria_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."categoria"');
            $field = new IntegerField('id_categoria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descripcion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Categoría', 'id_categoria', 'id_categoria_descripcion', 'edit_id_categoria_descripcion_search', $editor, $this->dataset, $lookupDataset, 'id_categoria', 'descripcion', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for url_doc field
            //
            $editor = new ImageUploader('url_doc_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Cargar Documento', 'url_doc', $editor, $this->dataset, false, false, 'documentos/', '%random%.%original_file_extension%', $this->OnGetCustomUploadFilename, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for url_video field
            //
            $editor = new TextEdit('url_video_edit');
            $editColumn = new CustomEditColumn('URL Video', 'url_video', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new UrlValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('UrlValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for url_anexos field
            //
            $editor = new ImageUploader('url_anexos_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Cargar Anexos', 'url_anexos', $editor, $this->dataset, false, false, 'anexos/', '%original_file_name%', $this->OnGetCustomUploadFilename, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for id_user field
            //
            $editor = new AutocompleteComboBox('id_user_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."user_student"');
            $field = new IntegerField('id_user');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('user_nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('user_password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('user_nombres', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Id User', 'id_user', 'id_user_user_nombres', 'edit_id_user_user_nombres_search', $editor, $this->dataset, $lookupDataset, 'id_user', 'user_nombres', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for nombre_proyecto field
            //
            $editor = new TextEdit('nombre_proyecto_edit');
            $editColumn = new CustomEditColumn('Nombre Proyecto', 'nombre_proyecto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for descripcion field
            //
            $editor = new HtmlWysiwygEditor('descripcion_edit');
            $editColumn = new CustomEditColumn('Descripción', 'descripcion', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fecha_publicacion field
            //
            $editor = new DateTimeEdit('fecha_publicacion_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Fecha Presentación', 'fecha_publicacion', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_feria field
            //
            $editor = new AutocompleteComboBox('id_feria_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."ferias"');
            $field = new IntegerField('id_feria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new DateTimeField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('periodo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombre_feria');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_feria', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Feria', 'id_feria', 'id_feria_nombre_feria', 'insert_id_feria_nombre_feria_search', $editor, $this->dataset, $lookupDataset, 'id_feria', 'nombre_feria', '%nombre_feria% - %fecha% - %periodo%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_categoria field
            //
            $editor = new AutocompleteComboBox('id_categoria_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."categoria"');
            $field = new IntegerField('id_categoria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descripcion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Categoría', 'id_categoria', 'id_categoria_descripcion', 'insert_id_categoria_descripcion_search', $editor, $this->dataset, $lookupDataset, 'id_categoria', 'descripcion', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for url_doc field
            //
            $editor = new ImageUploader('url_doc_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Cargar Documento', 'url_doc', $editor, $this->dataset, false, false, 'documentos/', '%random%.%original_file_extension%', $this->OnGetCustomUploadFilename, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for url_video field
            //
            $editor = new TextEdit('url_video_edit');
            $editColumn = new CustomEditColumn('URL Video', 'url_video', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new UrlValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('UrlValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for url_anexos field
            //
            $editor = new ImageUploader('url_anexos_edit');
            $editor->SetShowImage(false);
            $editColumn = new UploadFileToFolderColumn('Cargar Anexos', 'url_anexos', $editor, $this->dataset, false, false, 'anexos/', '%original_file_name%', $this->OnGetCustomUploadFilename, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for id_user field
            //
            $editor = new AutocompleteComboBox('id_user_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."user_student"');
            $field = new IntegerField('id_user');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('user_nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('user_password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('user_nombres', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Id User', 'id_user', 'id_user_user_nombres', 'insert_id_user_user_nombres_search', $editor, $this->dataset, $lookupDataset, 'id_user', 'user_nombres', '');
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetInsertDefaultValue('%CURRENT_USER_ID%');
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id_proyecto field
            //
            $column = new NumberViewColumn('id_proyecto', 'id_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(100);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_nombre_proyecto_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(250);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_descripcion_handler_print');
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fecha_publicacion field
            //
            $column = new DateTimeViewColumn('fecha_publicacion', 'fecha_publicacion', 'Fecha Presentación', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d ');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombre_feria field
            //
            $column = new TextViewColumn('id_feria', 'id_feria_nombre_feria', 'Feria', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('id_categoria', 'id_categoria_descripcion', 'Categoría', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for url_doc field
            //
            $column = new TextViewColumn('url_doc', 'url_doc', 'Cargar Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(50);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_url_video_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for url_anexos field
            //
            $column = new TextViewColumn('url_anexos', 'url_anexos', 'Cargar Anexos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for user_nombres field
            //
            $column = new TextViewColumn('id_user', 'id_user_user_nombres', 'Id User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id_proyecto field
            //
            $column = new NumberViewColumn('id_proyecto', 'id_proyecto', 'Id Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(100);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_nombre_proyecto_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(250);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_descripcion_handler_export');
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for fecha_publicacion field
            //
            $column = new DateTimeViewColumn('fecha_publicacion', 'fecha_publicacion', 'Fecha Presentación', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d ');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nombre_feria field
            //
            $column = new TextViewColumn('id_feria', 'id_feria_nombre_feria', 'Feria', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('id_categoria', 'id_categoria_descripcion', 'Categoría', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for url_doc field
            //
            $column = new TextViewColumn('url_doc', 'url_doc', 'Cargar Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(50);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_url_video_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for url_anexos field
            //
            $column = new TextViewColumn('url_anexos', 'url_anexos', 'Cargar Anexos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for user_nombres field
            //
            $column = new TextViewColumn('id_user', 'id_user_user_nombres', 'Id User', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(100);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_nombre_proyecto_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(250);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_descripcion_handler_compare');
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fecha_publicacion field
            //
            $column = new DateTimeViewColumn('fecha_publicacion', 'fecha_publicacion', 'Fecha Presentación', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d ');
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for nombre_feria field
            //
            $column = new TextViewColumn('id_feria', 'id_feria_nombre_feria', 'Feria', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for descripcion field
            //
            $column = new TextViewColumn('id_categoria', 'id_categoria_descripcion', 'Categoría', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for url_doc field
            //
            $column = new TextViewColumn('url_doc', 'url_doc', 'Cargar Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(50);
            $column->SetFullTextWindowHandlerName('public_proyectosGrid_url_video_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for url_anexos field
            //
            $column = new TextViewColumn('url_anexos', 'url_anexos', 'Cargar Anexos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for user_nombres field
            //
            $column = new TextViewColumn('id_user', 'id_user_user_nombres', 'Id User', $this->dataset);
            $column->SetOrderable(true);
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
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
        }
        
        protected function OnGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
        $layout->setMode(FormLayoutMode::VERTICAL);
                
        $displayGroup = $layout->addGroup('Datos del Proyecto',12);
        
        $displayGroup->addRow()->addCol($columns['nombre_proyecto'],4)->addCol($columns['id_categoria'],4)->addCol($columns['id_feria'],4);
        $displayGroup->addRow()->addCol($columns['descripcion'],12);
        $displayGroup->addRow()->addCol($columns['fecha_publicacion'],6)->addCol($columns['url_video'],6);
        $displayGroup->addRow()->addCol($columns['url_doc'],6)->addCol($columns['url_anexos'],6);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
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
            $grid->SetInsertClientFormLoadedScript($this->RenderText('editors[\'id_user\'].visible(false);'));
        }
    
        protected function doRegisterHandlers() {
            $detailPage = new public_proyectos_public_evaluacionPage('public_proyectos_public_evaluacion', $this, array('id_proyecto'), array('id_proyecto'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('public.proyectos.public.evaluacion'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('public.proyectos.public.evaluacion'));
            $detailPage->SetTitle('Evaluacion');
            $detailPage->SetMenuLabel('Evaluacion');
            $detailPage->SetHeader(GetPagesHeader());
            $detailPage->SetFooter(GetPagesFooter());
            $detailPage->SetHttpHandlerName('public_proyectos_public_evaluacion_handler');
            $handler = new PageHTTPHandler('public_proyectos_public_evaluacion_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);$detailPage = new public_proyectos_public_ganadores_feriaPage('public_proyectos_public_ganadores_feria', $this, array('id_proyecto'), array('id_proyecto'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionSetForDataSource('public.proyectos.public.ganadores_feria'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('public.proyectos.public.ganadores_feria'));
            $detailPage->SetTitle('Ganadores Feria');
            $detailPage->SetMenuLabel('Ganadores Feria');
            $detailPage->SetHeader(GetPagesHeader());
            $detailPage->SetFooter(GetPagesFooter());
            $detailPage->SetHttpHandlerName('public_proyectos_public_ganadores_feria_handler');
            $handler = new PageHTTPHandler('public_proyectos_public_ganadores_feria_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_nombre_proyecto_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_descripcion_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_url_video_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_nombre_proyecto_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_descripcion_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_url_video_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_nombre_proyecto_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_descripcion_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_url_video_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."ferias"');
            $field = new IntegerField('id_feria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new DateTimeField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('periodo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombre_feria');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_feria', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_id_feria_nombre_feria_search', 'id_feria', 'nombre_feria', $this->RenderText('%nombre_feria% - %fecha% - %periodo%'), 25);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."categoria"');
            $field = new IntegerField('id_categoria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descripcion', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_id_categoria_descripcion_search', 'id_categoria', 'descripcion', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."user_student"');
            $field = new IntegerField('id_user');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('user_nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('user_password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('user_nombres', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_id_user_user_nombres_search', 'id_user', 'user_nombres', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for nombre_proyecto field
            //
            $column = new TextViewColumn('nombre_proyecto', 'nombre_proyecto', 'Nombre Proyecto', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_nombre_proyecto_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for descripcion field
            //
            $column = new TextViewColumn('descripcion', 'descripcion', 'Descripción', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_descripcion_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for url_video field
            //
            $column = new TextViewColumn('url_video', 'url_video', 'URL Video', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'public_proyectosGrid_url_video_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."ferias"');
            $field = new IntegerField('id_feria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new DateTimeField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('periodo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombre_feria');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('nombre_feria', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_id_feria_nombre_feria_search', 'id_feria', 'nombre_feria', $this->RenderText('%nombre_feria% - %fecha% - %periodo%'), 25);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."categoria"');
            $field = new IntegerField('id_categoria', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('descripcion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descripcion', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_id_categoria_descripcion_search', 'id_categoria', 'descripcion', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);$lookupDataset = new TableDataset(
                PgConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '"public"."user_student"');
            $field = new IntegerField('id_user');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('user_nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('user_password');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('user_nombres', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_id_user_user_nombres_search', 'id_user', 'user_nombres', null, 20);
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
            $rowData['id_user']=$this->GetEnvVar('CURRENT_USER_ID');
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
        $Page = new public_proyectosPage("public_proyectos", "proyectos.php", GetCurrentUserPermissionSetForDataSource("public.proyectos"), 'UTF-8');
        $Page->SetTitle('Proyectos');
        $Page->SetMenuLabel('Proyectos');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("public.proyectos"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
