<?php

namespace FacturaScripts\Plugins\ProyectosDocumentos\Controller;

use FacturaScripts\Core\Base\DataBase\DataBaseWhere;

class EditProyecto extends \FacturaScripts\Plugins\Proyectos\Controller\EditProyecto
{
    use \FacturaScripts\Core\Lib\ExtendedController\DocFilesTrait;

    protected function createViews()
    {
        parent::createViews();
        $this->createViewDocFiles();
    }

    protected function execPreviousAction($action)
    {
        switch ($action) {
            case 'add-file':
                return $this->addFileAction();

            case 'delete-file':
                return $this->deleteFileAction();

            case 'edit-file':
                return $this->editFileAction();

            case 'unlink-file':
                return $this->unlinkFileAction();
        }

        return parent::execPreviousAction($action);
    }

    protected function loadData($viewName, $view)
    {
        switch ($viewName) {
            case 'docfiles':
                $code = $this->request->get('code');
                $where = [
                    new DataBaseWhere('model', 'Proyecto'),
                    new DataBaseWhere('modelid', $code)
                ];
                $view->loadData('', $where);
                return;
        }

        parent::loadData($viewName, $view);
    }
}
