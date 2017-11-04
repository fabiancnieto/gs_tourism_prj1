<?php

/**
 * Description of GuiFactory
 *
 * @author camilo
 */
class GuiFactory {

    public function getGui() {
        $objAbout = new About();
        $objPlan = new Plans();
        $objNews = new News();
        $objCarFleet = new CarFleet();
        return new GuiFacade($objAbout, $objPlan, $objNews, $objCarFleet);
    }
}

?>
