<?php

if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Index_EweiShopV2Page extends PluginWebPage
{
    public function main()
    {

        if (cv('qt.question')) {
            header('location: ' . webUrl('qt/question'));
        }
        else if (cv('qt.delete')) {
            header('location: ' . webUrl('qt/delete'));
        }
        else if (cv('qt.edit')) {
            header('location: ' . webUrl('qt/edit'));
        }
        else if (cv('qt.march')) {
            header('location: ' . webUrl('qt/march'));
        }
        else {
            header('location: ' . webUrl());
        }

        exit();
    }




}