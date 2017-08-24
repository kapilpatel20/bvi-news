<?php

namespace BviNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BviNewsBundle\Entity\News;
use BviNewsBundle\Form\NewsForm;
use DateTime;

class NewsController extends Controller {

    public function indexAction(Request $request) {
        
        $lstObj = $this->prepareListObj($request);
        $lstObj->setTemplate('BviNewsBundle:AjaxPagination:ajax_pagination.html.twig');
        
        if ($request->isXmlHttpRequest()) {
            
            $listView          =  $this->renderView('BviNewsBundle:News:_list.html.twig',array('lstObj' => $lstObj));
            $output['success'] = true;
            $output['listView']= $listView;
            $response = new Response(json_encode($output));
            return $response;
            
        }else{
            return $this->render('BviNewsBundle:News:index.html.twig',array('lstObj' => $lstObj));
        }
        
    }
    
    //prepare list object
    public function prepareListObj(Request $request) {
        
        $em        = $this->getDoctrine()->getManager();
        $params    = $this->get('request')->request->all();
        
        $qry       = $em->getRepository('BviNewsBundle:News')->getList($params);

        $itmPerPge = 20;
        // Creating pagnination
        $pagination = $this->get('knp_paginator')->paginate(
                $qry, $this->get('request')->query->get('page', 1), $itmPerPge
        );
        
        return $pagination;
    }
    
    //add news
    
    public function newAction(Request $request) {
        
        $objNews = new News();
        $form = $this->createForm(new NewsForm(), $objNews);
        
        if ($request->getMethod() == "POST") {

            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $objNews->setCreatedat(new DateTime());
                $user = $this->get('security.context')->getToken()->getUser();
                if (is_object($user)) {
                    $objNews->setCreatedby($user->getId());
                }else{
                    $objNews->setCreatedby(1);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($objNews);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', "Record has been added successfully.");
                return $this->redirect($this->generateUrl('bvi_news_list'));
            }
        }
        
        return $this->render('BviNewsBundle:News:new.html.twig', array(
                    'form' => $form->createView()
        ));
    }
    
    //edit News page
    
    public function editAction(Request $request,$id = '') {
        
        $em = $this->getDoctrine()->getManager();
        $objNews = $em->getRepository('BviNewsBundle:News')->find($id);
        
        if (!$objNews) {

            $this->get('session')->getFlashBag()->add('failure', "News does not exist.");
            return $this->redirect($this->generateUrl('bvi_news_list'));
        }
        $form = $this->createForm(new NewsForm(), $objNews);

        if ($request->getMethod() == "POST") {

            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $objNews->setUpdatedat(new DateTime());
                $user = $this->get('security.context')->getToken()->getUser();
                if (is_object($user)) {
                    $objNews->setUpdatedby($user->getId());
                }
                $em->persist($objNews);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', "Record has been updated successfully.");
                return $this->redirect($this->generateUrl('bvi_news_list'));
            }
        }
        return $this->render('BviNewsBundle:News:edit.html.twig', array(
                    'form' => $form->createView(),'objNews' => $objNews
        ));
    }
    
    //update status of news
    
    public function updateStatusAction(Request $request) {
        
        $em     = $this->getDoctrine()->getManager();
        $id     = $request->get('id');
        $objNews= $em->getRepository('BviNewsBundle:News')->find($id);
        $success= false;
        
        if (is_object($objNews)) {
            
            $status = $objNews->getStatus() == 'Active' ? 'Inactive' : 'Active';
            $objNews->setStatus($status);
            $objNews->setUpdatedat(new DateTime());
            $user = $this->get('security.context')->getToken()->getUser();
            if (is_object($user)) {
                $objNews->setUpdatedby($user->getId());
            }
            $em->persist($objNews);
            $em->flush();
            $success = true;
        }
        
        $output['success'] = $success;
        $output['msg']     = 'Record updated successfully';
        $response          = new Response(json_encode($output));
        return $response;
    } 
    
    //delete news
    
    public function deleteNewsAction(Request $request) {
        
        $em     = $this->getDoctrine()->getManager();
        $id     = $request->get('id');
        $objNews= $em->getRepository('BviNewsBundle:News')->find($id);
        $success= false;
        
        if (is_object($objNews)) {
            
            $em->remove($objNews);
            $em->persist($objNews);
            $em->flush();
            $success = true;
        }
        
        $output['success'] = $success;
        $output['msg']     = 'Record deleted successfully';
        $response          = new Response(json_encode($output));
        return $response;
    }  
    
}    
    