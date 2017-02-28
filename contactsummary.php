<?php

require_once 'contactsummary.civix.php';

/**
 * Place a link to Kennismakingsgesprek webform
 *
 * Implementation of hook_civicrm_summary
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_summary
 */
function contactsummary_civicrm_pageRun(&$page) {
  if ($page instanceof CRM_Contact_Page_View_Summary) {
    try {
      $contact = civicrm_api3('Contact', 'getsingle', array(
        'id' => $page->getVar('_contactId'),
        'contact_sub_type' => "Buddy",
      ));
      $kennismakingsgesprekLink = "https://crm.cvvede.nl/civicrm/contact/kennismakingsgesprek?cid2=".$page->getVar('_contactId');
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => "CRM/Contact/Page/View/Summary/link_to_kennismakingsgesprek.tpl"
      ));

      $smarty = CRM_Core_Smarty::singleton();
      $smarty->assign('link_to_kennismakingsgesprek', $kennismakingsgesprekLink);
    } catch (Exception $e) {
      // Do nothing
    }
  }
}

function contactsummary_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Activity_Form_ActivityLinks') {
    $activityTypeToHide = array();
    $activityTypeToHide[] = civicrm_api3('OptionValue', 'getvalue', array('label' => 'Inschrijving Buddy', 'return' => 'value', 'option_group_id' => 'activity_type'));
    $activityTypeToHide[] = civicrm_api3('OptionValue', 'getvalue', array('label' => 'Oproepje', 'return' => 'value', 'option_group_id' => 'activity_type'));
    $activityTypeToHide[] = civicrm_api3('OptionValue', 'getvalue', array('label' => 'Oproepje plaatsen', 'return' => 'value', 'option_group_id' => 'activity_type'));
    $activityTypeToHide[] = civicrm_api3('OptionValue', 'getvalue', array('label' => 'Kennismakingsgesprek', 'return' => 'value', 'option_group_id' => 'activity_type'));
    $activityTypeToHide[] = civicrm_api3('OptionValue', 'getvalue', array('label' => 'E-mailen / telefoneren', 'return' => 'value', 'option_group_id' => 'activity_type'));
    $activityTypeToHide[] = civicrm_api3('OptionValue', 'getvalue', array('label' => 'Systeem verbeteren', 'return' => 'value', 'option_group_id' => 'activity_type'));
    $activityTypeToHide[] = civicrm_api3('OptionValue', 'getvalue', array('label' => 'Uitzoekwerk / documentatie', 'return' => 'value', 'option_group_id' => 'activity_type'));

    $urls = $form->get_template_vars('urls');
    foreach($urls as $activity_type_id => $activity_link) {
      if (in_array($activity_type_id, $activityTypeToHide)) {
        unset($urls[$activity_type_id]);
      }
    }
    $form->assign('urls', $urls);
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function contactsummary_civicrm_config(&$config) {
  _contactsummary_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function contactsummary_civicrm_xmlMenu(&$files) {
  _contactsummary_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function contactsummary_civicrm_install() {
  _contactsummary_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function contactsummary_civicrm_uninstall() {
  _contactsummary_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function contactsummary_civicrm_enable() {
  _contactsummary_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function contactsummary_civicrm_disable() {
  _contactsummary_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function contactsummary_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _contactsummary_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function contactsummary_civicrm_managed(&$entities) {
  _contactsummary_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contactsummary_civicrm_caseTypes(&$caseTypes) {
  _contactsummary_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function contactsummary_civicrm_angularModules(&$angularModules) {
_contactsummary_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function contactsummary_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _contactsummary_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function contactsummary_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function contactsummary_civicrm_navigationMenu(&$menu) {
  _contactsummary_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'nl.cvvede.contactsummary')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _contactsummary_civix_navigationMenu($menu);
} // */
