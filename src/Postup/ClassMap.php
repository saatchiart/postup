<?php
/**
 * Class which returns the class map definition by the static method ClassMap::classMap()
 * @date 2015-02-10
 */

namespace Demand\Postup;

class ClassMap
{
    /**
     * This method returns the array containing the mapping between WSDL structs and generated classes
     * This array is sent to the SoapClient when calling the WS
     * @return array
     */
    final public static function classMap()
    {
        return array (
//          'Content' => 'Postup_StructContent',
//          'CustomField' => 'Postup_StructCustomField',
//          'DetailedMailingReport' => 'Postup_StructDetailedMailingReport',
//          'EmailContent' => 'Postup_StructEmailContent',
//          'FTPLocation' => 'Postup_StructFTPLocation',
//          'FacebookContent' => 'Postup_StructFacebookContent',
//          'HTTPLocation' => 'Postup_StructHTTPLocation',
//          'IdAndTitle' => 'Postup_StructIdAndTitle',
//          'ImportTemplate' => 'Postup_StructImportTemplate',
//          'ImportTemplateOptions' => 'Postup_StructImportTemplateOptions',
//          'LinkReport' => 'Postup_StructLinkReport',
          'List' => 'Demand\Postup\Struct\ListStruct',
//          'ListSubscription' => 'Postup_StructListSubscription',
//          'Mailing' => 'Postup_StructMailing',
//          'MailingPartReport' => 'Postup_StructMailingPartReport',
//          'MailingReport' => 'Postup_StructMailingReport',
//          'RecipField' => 'Postup_StructRecipField',
          'Recipient' => 'Demand\Postup\Struct\Recipient',
//          'RecipientData' => 'Postup_StructRecipientData',
//          'SMSContent' => 'Postup_StructSMSContent',
//          'SendTemplateBean' => 'Postup_StructSendTemplateBean',
//          'SubscriptionInfo' => 'Postup_StructSubscriptionInfo',
//          'SummaryCampaignReport' => 'Postup_StructSummaryCampaignReport',
//          'SummaryMailingReport' => 'Postup_StructSummaryMailingReport',
//          'authentication' => 'Postup_StructAuthentication',
        );
    }
}
