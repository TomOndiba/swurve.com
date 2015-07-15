<?php

if (!class_exists("GetSingleSignOnURLRequest")) {
/**
 * GetSingleSignOnURLRequest
 */
class GetSingleSignOnURLRequest {
}}

if (!class_exists("connectionInfo")) {
/**
 * connectionInfo
 */
class connectionInfo {
    /**
     * @access public
     * @var string
     */
    public $databaseName;
    /**
     * @access public
     * @var tnsDatabaseType
     */
    public $databaseType;
    /**
     * @access public
     * @var string
     */
    public $hostname;
    /**
     * @access public
     * @var string
     */
    public $password;
    /**
     * @access public
     * @var string
     */
    public $port;
    /**
     * @access public
     * @var string
     */
    public $username;
}}

if (!class_exists("hourlyRefresh")) {
/**
 * hourlyRefresh
 */
class hourlyRefresh {
    /**
     * @access public
     * @var tnsHourlyInterval
     */
    public $interval;
}}

if (!class_exists("dailyRefresh")) {
/**
 * dailyRefresh
 */
class dailyRefresh {
    /**
     * @access public
     * @var time
     */
    public $startTime;
}}

if (!class_exists("weeklyRefresh")) {
/**
 * weeklyRefresh
 */
class weeklyRefresh {
    /**
     * @access public
     * @var time
     */
    public $startTime;
    /**
     * @access public
     * @var tnsDayOfWeek[]
     */
    public $day;
}}

if (!class_exists("DataSourceType")) {
/**
 * DataSourceType
 */
class DataSourceType {
}}

if (!class_exists("DatabaseType")) {
/**
 * DatabaseType
 */
class DatabaseType {
}}

if (!class_exists("DataSourceField")) {
/**
 * DataSourceField
 */
class DataSourceField {
    /**
     * @access public
     * @var tnsDataSourceDataType
     */
    public $dataType;
    /**
     * @access public
     * @var tnsDataSourceFieldType
     */
    public $fieldType;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var boolean
     */
    public $isPrimaryKey;
    /**
     * @access public
     * @var boolean
     */
    public $writebackEnabled;
}}

if (!class_exists("DataSourceFieldType")) {
/**
 * DataSourceFieldType
 */
class DataSourceFieldType {
}}

if (!class_exists("DataSourceDataType")) {
/**
 * DataSourceDataType
 */
class DataSourceDataType {
}}

if (!class_exists("DataSourceRecord")) {
/**
 * DataSourceRecord
 */
class DataSourceRecord {
    /**
     * @access public
     * @var NameValuePair[]
     */
    public $field;
}}

if (!class_exists("DataSourceOperationStatus")) {
/**
 * DataSourceOperationStatus
 */
class DataSourceOperationStatus {
}}

if (!class_exists("DataSourceDedupeOption")) {
/**
 * DataSourceDedupeOption
 */
class DataSourceDedupeOption {
}}

if (!class_exists("DataSourceOrderBy")) {
/**
 * DataSourceOrderBy
 */
class DataSourceOrderBy {
}}

if (!class_exists("RefreshRecordsRequest")) {
/**
 * RefreshRecordsRequest
 */
class RefreshRecordsRequest {
    /**
     * @access public
     * @var ExternalDataSourceId
     */
    public $dataSourceId;
}}

if (!class_exists("CancelRefreshRecordsRequest")) {
/**
 * CancelRefreshRecordsRequest
 */
class CancelRefreshRecordsRequest {
    /**
     * @access public
     * @var ExternalDataSourceId
     */
    public $dataSourceId;
}}

if (!class_exists("TargetType")) {
/**
 * TargetType
 */
class TargetType {
}}

if (!class_exists("TargetOrderBy")) {
/**
 * TargetOrderBy
 */
class TargetOrderBy {
}}

if (!class_exists("SuppressionListOrderBy")) {
/**
 * SuppressionListOrderBy
 */
class SuppressionListOrderBy {
}}

if (!class_exists("SeedListOrderBy")) {
/**
 * SeedListOrderBy
 */
class SeedListOrderBy {
}}

if (!class_exists("TrackingTag")) {
/**
 * TrackingTag
 */
class TrackingTag {
}}

if (!class_exists("OpenTag")) {
/**
 * OpenTag
 */
class OpenTag {
}}

if (!class_exists("TrackingTagProperties")) {
/**
 * TrackingTagProperties
 */
class TrackingTagProperties {
    /**
     * @access public
     * @var string
     */
    public $title;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $offerUrl;
    /**
     * @access public
     * @var string
     */
    public $imageUrl;
}}

if (!class_exists("NamedLink")) {
/**
 * NamedLink
 */
class NamedLink {
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var string
     */
    public $url;
    /**
     * @access public
     * @var string
     */
    public $linkId;
    /**
     * @access public
     * @var tnsTrackingTag
     */
    public $trackingTag;
    /**
     * @access public
     * @var TrackingTagProperties
     */
    public $trackingTagProperties;
    /**
     * @access public
     * @var WebAnalytics
     */
    public $webAnalytics;
}}

if (!class_exists("MessagePart")) {
/**
 * MessagePart
 */
class MessagePart {
    /**
     * @access public
     * @var string
     */
    public $content;
    /**
     * @access public
     * @var tnsMessageFormat
     */
    public $format;
    /**
     * @access public
     * @var string
     */
    public $mediaServerFolderName;
    /**
     * @access public
     * @var MediaServerId
     */
    public $mediaServerId;
    /**
     * @access public
     * @var boolean
     */
    public $isXsl;
    /**
     * @access public
     * @var tnsOpenTag
     */
    public $openTag;
    /**
     * @access public
     * @var NamedLink[]
     */
    public $namedLinks;
}}

if (!class_exists("MessageFormat")) {
/**
 * MessageFormat
 */
class MessageFormat {
}}

if (!class_exists("MessageType")) {
/**
 * MessageType
 */
class MessageType {
}}

if (!class_exists("TemplateOrderBy")) {
/**
 * TemplateOrderBy
 */
class TemplateOrderBy {
}}

if (!class_exists("ImportMessagePartRequest")) {
/**
 * ImportMessagePartRequest
 */
class ImportMessagePartRequest {
    /**
     * @access public
     * @var TemplateId
     */
    public $templateId;
    /**
     * @access public
     * @var MediaServerId
     */
    public $mediaServerId;
    /**
     * @access public
     * @var boolean
     */
    public $isXsl;
    /**
     * @access public
     * @var string
     */
    public $folderName;
    /**
     * @access public
     * @var base64Binary
     */
    public $zipFile;
}}

if (!class_exists("ValidateXslRequest")) {
/**
 * ValidateXslRequest
 */
class ValidateXslRequest {
    /**
     * @access public
     * @var TemplateId
     */
    public $templateId;
    /**
     * @access public
     * @var tnsMessageFormat
     */
    public $messageFormat;
}}

if (!class_exists("FetchLinksRequest")) {
/**
 * FetchLinksRequest
 */
class FetchLinksRequest {
}}

if (!class_exists("FetchLinksTemplateRequest")) {
/**
 * FetchLinksTemplateRequest
 */
class FetchLinksTemplateRequest extends FetchLinksRequest {
    /**
     * @access public
     * @var Template
     */
    public $template;
    /**
     * @access public
     * @var tnsMessageFormat
     */
    public $messageFormat;
}}

if (!class_exists("ContentBlockToken")) {
/**
 * ContentBlockToken
 */
class ContentBlockToken {
    /**
     * @access public
     * @var ContentBlockId
     */
    public $contentBlockId;
    /**
     * @access public
     * @var string
     */
    public $token;
}}

if (!class_exists("ContentBlockOrderBy")) {
/**
 * ContentBlockOrderBy
 */
class ContentBlockOrderBy {
}}

if (!class_exists("FetchLinksContentBlockRequest")) {
/**
 * FetchLinksContentBlockRequest
 */
class FetchLinksContentBlockRequest extends FetchLinksRequest {
    /**
     * @access public
     * @var ContentBlock
     */
    public $contentBlock;
}}

if (!class_exists("AttachmentOrderBy")) {
/**
 * AttachmentOrderBy
 */
class AttachmentOrderBy {
}}

if (!class_exists("RuleValue")) {
/**
 * RuleValue
 */
class RuleValue {
}}

if (!class_exists("ColumnRuleValue")) {
/**
 * ColumnRuleValue
 */
class ColumnRuleValue extends RuleValue {
    /**
     * @access public
     * @var string
     */
    public $value;
}}

if (!class_exists("ContentBlockTokenRuleValue")) {
/**
 * ContentBlockTokenRuleValue
 */
class ContentBlockTokenRuleValue extends RuleValue {
    /**
     * @access public
     * @var ContentBlockToken
     */
    public $value;
}}

if (!class_exists("TextRuleValue")) {
/**
 * TextRuleValue
 */
class TextRuleValue extends RuleValue {
    /**
     * @access public
     * @var string
     */
    public $value;
}}

if (!class_exists("NestedRuleRuleValue")) {
/**
 * NestedRuleRuleValue
 */
class NestedRuleRuleValue extends RuleValue {
    /**
     * @access public
     * @var RuleId
     */
    public $value;
}}

if (!class_exists("RuleIfPartCondition")) {
/**
 * RuleIfPartCondition
 */
class RuleIfPartCondition {
    /**
     * @access public
     * @var string
     */
    public $column;
    /**
     * @access public
     * @var tnsComparisonOperation
     */
    public $op;
    /**
     * @access public
     * @var string
     */
    public $value;
}}

if (!class_exists("RuleIfPart")) {
/**
 * RuleIfPart
 */
class RuleIfPart {
    /**
     * @access public
     * @var RuleIfPartCondition
     */
    public $condition1;
    /**
     * @access public
     * @var tnsLogicalOperation
     */
    public $logicalOperation;
    /**
     * @access public
     * @var RuleIfPartCondition
     */
    public $condition;
}}

if (!class_exists("RuleThenPart")) {
/**
 * RuleThenPart
 */
class RuleThenPart {
    /**
     * @access public
     * @var ColumnRuleValue
     */
    public $columnRuleValue;
    /**
     * @access public
     * @var ContentBlockTokenRuleValue
     */
    public $contentBlockTokenRuleValue;
    /**
     * @access public
     * @var TextRuleValue
     */
    public $textRuleValue;
}}

if (!class_exists("RuleElsePart")) {
/**
 * RuleElsePart
 */
class RuleElsePart {
    /**
     * @access public
     * @var ColumnRuleValue
     */
    public $columnRuleValue;
    /**
     * @access public
     * @var ContentBlockTokenRuleValue
     */
    public $contentBlockTokenRuleValue;
    /**
     * @access public
     * @var NestedRuleRuleValue
     */
    public $nestedRuleRuleValue;
    /**
     * @access public
     * @var TextRuleValue
     */
    public $textRuleValue;
}}

if (!class_exists("RuleOrderBy")) {
/**
 * RuleOrderBy
 */
class RuleOrderBy {
}}

if (!class_exists("schedule")) {
/**
 * schedule
 */
class schedule {
    /**
     * @access public
     * @var dateTime
     */
    public $startDateTime;
    /**
     * @access public
     * @var anyType
     */
    public $recurrence;
    /**
     * @access public
     * @var date
     */
    public $endDate;
    /**
     * @access public
     * @var integer
     */
    public $endAfterXMailings;
    /**
     * @access public
     * @var anyType
     */
    public $minutelyRecurrence;
    /**
     * @access public
     * @var tnsMinutelyInterval
     */
    public $interval;
    /**
     * @access public
     * @var anyType
     */
    public $hourlyRecurrence;
    /**
     * @access public
     * @var anyType
     */
    public $dailyRecurrence;
    /**
     * @access public
     * @var boolean
     */
    public $everyWeekDay;
    /**
     * @access public
     * @var anyType
     */
    public $weeklyRecurrence;
    /**
     * @access public
     * @var tnsDayOfWeek[]
     */
    public $day;
    /**
     * @access public
     * @var anyType
     */
    public $monthlyByDateRecurrence;
    /**
     * @access public
     * @var tnsDayOfMonth[]
     */
    public $dayOfMonth;
    /**
     * @access public
     * @var anyType
     */
    public $monthlyByDayRecurrence;
    /**
     * @access public
     * @var tnsWeeklyOccurrence
     */
    public $weeklyOccurrence;
    /**
     * @access public
     * @var tnsDailyOccurrence
     */
    public $dailyOccurrence;
    /**
     * @access public
     * @var anyType
     */
    public $yearlyByDateRecurrence;
    /**
     * @access public
     * @var tnsMonth
     */
    public $month;
    /**
     * @access public
     * @var anyType
     */
    public $yearlyByDayRecurrence;
    /**
     * @access public
     * @var dateTime
     */
    public $nextScheduledDateTime;
}}

if (!class_exists("recurrence")) {
/**
 * recurrence
 */
class recurrence {
    /**
     * @access public
     * @var date
     */
    public $endDate;
    /**
     * @access public
     * @var integer
     */
    public $endAfterXMailings;
    /**
     * @access public
     * @var anyType
     */
    public $minutelyRecurrence;
    /**
     * @access public
     * @var tnsMinutelyInterval
     */
    public $interval;
    /**
     * @access public
     * @var anyType
     */
    public $hourlyRecurrence;
    /**
     * @access public
     * @var anyType
     */
    public $dailyRecurrence;
    /**
     * @access public
     * @var boolean
     */
    public $everyWeekDay;
    /**
     * @access public
     * @var anyType
     */
    public $weeklyRecurrence;
    /**
     * @access public
     * @var tnsDayOfWeek[]
     */
    public $day;
    /**
     * @access public
     * @var anyType
     */
    public $monthlyByDateRecurrence;
    /**
     * @access public
     * @var tnsDayOfMonth[]
     */
    public $dayOfMonth;
    /**
     * @access public
     * @var anyType
     */
    public $monthlyByDayRecurrence;
    /**
     * @access public
     * @var tnsWeeklyOccurrence
     */
    public $weeklyOccurrence;
    /**
     * @access public
     * @var tnsDailyOccurrence
     */
    public $dailyOccurrence;
    /**
     * @access public
     * @var anyType
     */
    public $yearlyByDateRecurrence;
    /**
     * @access public
     * @var tnsMonth
     */
    public $month;
    /**
     * @access public
     * @var anyType
     */
    public $yearlyByDayRecurrence;
    /**
     * @access public
     * @var dateTime
     */
    public $nextScheduledDateTime;
}}

if (!class_exists("minutelyRecurrence")) {
/**
 * minutelyRecurrence
 */
class minutelyRecurrence {
    /**
     * @access public
     * @var tnsMinutelyInterval
     */
    public $interval;
}}

if (!class_exists("hourlyRecurrence")) {
/**
 * hourlyRecurrence
 */
class hourlyRecurrence {
    /**
     * @access public
     * @var tnsHourlyInterval
     */
    public $interval;
}}

if (!class_exists("dailyRecurrence")) {
/**
 * dailyRecurrence
 */
class dailyRecurrence {
    /**
     * @access public
     * @var tnsDailyInterval
     */
    public $interval;
    /**
     * @access public
     * @var boolean
     */
    public $everyWeekDay;
}}

if (!class_exists("weeklyRecurrence")) {
/**
 * weeklyRecurrence
 */
class weeklyRecurrence {
    /**
     * @access public
     * @var tnsWeeklyInterval
     */
    public $interval;
    /**
     * @access public
     * @var tnsDayOfWeek[]
     */
    public $day;
}}

if (!class_exists("monthlyByDateRecurrence")) {
/**
 * monthlyByDateRecurrence
 */
class monthlyByDateRecurrence {
    /**
     * @access public
     * @var tnsMonthlyInterval
     */
    public $interval;
    /**
     * @access public
     * @var tnsDayOfMonth[]
     */
    public $dayOfMonth;
}}

if (!class_exists("monthlyByDayRecurrence")) {
/**
 * monthlyByDayRecurrence
 */
class monthlyByDayRecurrence {
    /**
     * @access public
     * @var tnsMonthlyInterval
     */
    public $interval;
    /**
     * @access public
     * @var tnsWeeklyOccurrence
     */
    public $weeklyOccurrence;
    /**
     * @access public
     * @var tnsDailyOccurrence
     */
    public $dailyOccurrence;
}}

if (!class_exists("yearlyByDateRecurrence")) {
/**
 * yearlyByDateRecurrence
 */
class yearlyByDateRecurrence {
    /**
     * @access public
     * @var tnsMonth
     */
    public $month;
    /**
     * @access public
     * @var tnsDayOfMonth
     */
    public $day;
}}

if (!class_exists("yearlyByDayRecurrence")) {
/**
 * yearlyByDayRecurrence
 */
class yearlyByDayRecurrence {
    /**
     * @access public
     * @var tnsMonth
     */
    public $month;
    /**
     * @access public
     * @var tnsWeeklyOccurrence
     */
    public $weeklyOccurrence;
    /**
     * @access public
     * @var tnsDailyOccurrence
     */
    public $dailyOccurrence;
}}

if (!class_exists("MailingStatus")) {
/**
 * MailingStatus
 */
class MailingStatus {
}}

if (!class_exists("MailingType")) {
/**
 * MailingType
 */
class MailingType {
}}

if (!class_exists("MailingPriority")) {
/**
 * MailingPriority
 */
class MailingPriority {
}}

if (!class_exists("MinutelyInterval")) {
/**
 * MinutelyInterval
 */
class MinutelyInterval {
}}

if (!class_exists("HourlyInterval")) {
/**
 * HourlyInterval
 */
class HourlyInterval {
}}

if (!class_exists("DailyInterval")) {
/**
 * DailyInterval
 */
class DailyInterval {
}}

if (!class_exists("WeeklyInterval")) {
/**
 * WeeklyInterval
 */
class WeeklyInterval {
}}

if (!class_exists("MonthlyInterval")) {
/**
 * MonthlyInterval
 */
class MonthlyInterval {
}}

if (!class_exists("DailyOccurrence")) {
/**
 * DailyOccurrence
 */
class DailyOccurrence {
}}

if (!class_exists("WeeklyOccurrence")) {
/**
 * WeeklyOccurrence
 */
class WeeklyOccurrence {
}}

if (!class_exists("MailingOrderBy")) {
/**
 * MailingOrderBy
 */
class MailingOrderBy {
}}

if (!class_exists("AssetExpiryInterval")) {
/**
 * AssetExpiryInterval
 */
class AssetExpiryInterval {
}}

if (!class_exists("CancelRequest")) {
/**
 * CancelRequest
 */
class CancelRequest {
    /**
     * @access public
     * @var MailingId
     */
    public $mailingId;
}}

if (!class_exists("CloseRequest")) {
/**
 * CloseRequest
 */
class CloseRequest {
    /**
     * @access public
     * @var TransactionalMailingId
     */
    public $mailingId;
}}

if (!class_exists("ArchiveRequest")) {
/**
 * ArchiveRequest
 */
class ArchiveRequest {
    /**
     * @access public
     * @var MailingId
     */
    public $mailingId;
}}

if (!class_exists("LaunchRequest")) {
/**
 * LaunchRequest
 */
class LaunchRequest {
    /**
     * @access public
     * @var StandardMailingId
     */
    public $mailingId;
}}

if (!class_exists("LoadRequest")) {
/**
 * LoadRequest
 */
class LoadRequest {
    /**
     * @access public
     * @var TransactionalMailingId
     */
    public $mailingId;
}}

if (!class_exists("PauseRequest")) {
/**
 * PauseRequest
 */
class PauseRequest {
    /**
     * @access public
     * @var MailingId
     */
    public $mailingId;
}}

if (!class_exists("ResumeRequest")) {
/**
 * ResumeRequest
 */
class ResumeRequest {
    /**
     * @access public
     * @var MailingId
     */
    public $mailingId;
}}

if (!class_exists("ScheduleRequest")) {
/**
 * ScheduleRequest
 */
class ScheduleRequest {
    /**
     * @access public
     * @var StandardMailingId
     */
    public $mailingId;
}}

if (!class_exists("SendRecord")) {
/**
 * SendRecord
 */
class SendRecord {
    /**
     * @access public
     * @var NameValuePair[]
     */
    public $field;
}}

if (!class_exists("SendRequest")) {
/**
 * SendRequest
 */
class SendRequest {
    /**
     * @access public
     * @var TransactionalMailingId
     */
    public $mailingId;
    /**
     * @access public
     * @var string
     */
    public $sendData;
    /**
     * @access public
     * @var SendRecord[]
     */
    public $sendRecord;
}}

if (!class_exists("GetTxnMailingHandleRequest")) {
/**
 * GetTxnMailingHandleRequest
 */
class GetTxnMailingHandleRequest {
    /**
     * @access public
     * @var TransactionalMailingId
     */
    public $mailingId;
    /**
     * @access public
     * @var string
     */
    public $mailingName;
}}

if (!class_exists("TxnSendRequest")) {
/**
 * TxnSendRequest
 */
class TxnSendRequest {
    /**
     * @access public
     * @var string
     */
    public $handle;
    /**
     * @access public
     * @var SendRecord[]
     */
    public $sendRecord;
}}

if (!class_exists("GetTxnEasInfoRequest")) {
/**
 * GetTxnEasInfoRequest
 */
class GetTxnEasInfoRequest {
    /**
     * @access public
     * @var TransactionalMailingId
     */
    public $mailingId;
}}

if (!class_exists("OrganizationOrderBy")) {
/**
 * OrganizationOrderBy
 */
class OrganizationOrderBy {
}}

if (!class_exists("access")) {
/**
 * access
 */
class access {
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var RoleId
     */
    public $roleId;
}}

if (!class_exists("UserOrderBy")) {
/**
 * UserOrderBy
 */
class UserOrderBy {
}}

if (!class_exists("RolePermissions")) {
/**
 * RolePermissions
 */
class RolePermissions {
    /**
     * @access public
     * @var boolean
     */
    public $create;
    /**
     * @access public
     * @var boolean
     */
    public $update;
    /**
     * @access public
     * @var boolean
     */
    public $delete;
    /**
     * @access public
     * @var boolean
     */
    public $view;
    /**
     * @access public
     * @var boolean
     */
    public $approve;
    /**
     * @access public
     * @var boolean
     */
    public $advanced;
}}

if (!class_exists("Permissions")) {
/**
 * Permissions
 */
class Permissions {
    /**
     * @access public
     * @var RolePermissions
     */
    public $internalDataSources;
    /**
     * @access public
     * @var RolePermissions
     */
    public $externalDataSources;
    /**
     * @access public
     * @var RolePermissions
     */
    public $targets;
    /**
     * @access public
     * @var RolePermissions
     */
    public $suppressionLists;
    /**
     * @access public
     * @var RolePermissions
     */
    public $seedLists;
    /**
     * @access public
     * @var RolePermissions
     */
    public $messageTemplates;
    /**
     * @access public
     * @var RolePermissions
     */
    public $attachments;
    /**
     * @access public
     * @var RolePermissions
     */
    public $contentBlocks;
    /**
     * @access public
     * @var RolePermissions
     */
    public $mailings;
    /**
     * @access public
     * @var RolePermissions
     */
    public $txMailings;
    /**
     * @access public
     * @var RolePermissions
     */
    public $reports;
    /**
     * @access public
     * @var RolePermissions
     */
    public $bounceAddresses;
    /**
     * @access public
     * @var RolePermissions
     */
    public $fromAddresses;
    /**
     * @access public
     * @var RolePermissions
     */
    public $replyAddresses;
}}

if (!class_exists("RoleOrderBy")) {
/**
 * RoleOrderBy
 */
class RoleOrderBy {
}}

if (!class_exists("AssignedRoleOrderBy")) {
/**
 * AssignedRoleOrderBy
 */
class AssignedRoleOrderBy {
}}

if (!class_exists("SystemAddressType")) {
/**
 * SystemAddressType
 */
class SystemAddressType {
}}

if (!class_exists("SystemAddressOrderBy")) {
/**
 * SystemAddressOrderBy
 */
class SystemAddressOrderBy {
}}

if (!class_exists("CampaignOrderBy")) {
/**
 * CampaignOrderBy
 */
class CampaignOrderBy {
}}

if (!class_exists("server")) {
/**
 * server
 */
class server {
    /**
     * @access public
     * @var string
     */
    public $defaultImagePath;
    /**
     * @access public
     * @var string
     */
    public $host;
    /**
     * @access public
     * @var string
     */
    public $login;
    /**
     * @access public
     * @var string
     */
    public $password;
    /**
     * @access public
     * @var integer
     */
    public $sshPort;
}}

if (!class_exists("MediaServerOrderBy")) {
/**
 * MediaServerOrderBy
 */
class MediaServerOrderBy {
}}

if (!class_exists("WebAnalyticsOrderBy")) {
/**
 * WebAnalyticsOrderBy
 */
class WebAnalyticsOrderBy {
}}

if (!class_exists("MailingClassOrderBy")) {
/**
 * MailingClassOrderBy
 */
class MailingClassOrderBy {
}}

if (!class_exists("Forward2FriendOfferTrackingOption")) {
/**
 * Forward2FriendOfferTrackingOption
 */
class Forward2FriendOfferTrackingOption {
}}

if (!class_exists("StrongtoolOpenAs")) {
/**
 * StrongtoolOpenAs
 */
class StrongtoolOpenAs {
}}

if (!class_exists("StrongtoolOrderBy")) {
/**
 * StrongtoolOrderBy
 */
class StrongtoolOrderBy {
}}

if (!class_exists("OrganizationToken")) {
/**
 * OrganizationToken
 */
class OrganizationToken {
    /**
     * @access public
     * @var string
     */
    public $organizationName;
    /**
     * @access public
     * @var OrganizationId
     */
    public $subOrganizationId;
}}

if (!class_exists("IsSSO")) {
/**
 * IsSSO
 */
class IsSSO {
}}

if (!class_exists("ObjectId")) {
/**
 * ObjectId
 */
class ObjectId {
    /**
     * @access public
     * @var string
     */
    public $id;
}}

if (!class_exists("BaseObject")) {
/**
 * BaseObject
 */
class BaseObject {
    /**
     * @access public
     * @var dateTime
     */
    public $modifiedTime;
    /**
     * @access public
     * @var ObjectId
     */
    public $objectId;
    /**
     * @access public
     * @var integer
     */
    public $version;
}}

if (!class_exists("DedupeRecordsRequest")) {
/**
 * DedupeRecordsRequest
 */
class DedupeRecordsRequest {
    /**
     * @access public
     * @var string[]
     */
    public $matchField;
}}

if (!class_exists("DayOfWeek")) {
/**
 * DayOfWeek
 */
class DayOfWeek {
}}

if (!class_exists("DayOfMonth")) {
/**
 * DayOfMonth
 */
class DayOfMonth {
}}

if (!class_exists("Month")) {
/**
 * Month
 */
class Month {
}}

if (!class_exists("NameValuePair")) {
/**
 * NameValuePair
 */
class NameValuePair {
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var string
     */
    public $value;
}}

if (!class_exists("Token")) {
/**
 * Token
 */
class Token {
}}

if (!class_exists("BaseFilter")) {
/**
 * BaseFilter
 */
class BaseFilter {
    /**
     * @access public
     * @var boolean
     */
    public $isAscending;
    /**
     * @access public
     * @var integer
     */
    public $pageNumber;
    /**
     * @access public
     * @var integer
     */
    public $recordsPerPage;
    /**
     * @access public
     * @var integer
     */
    public $maxRecordsPerPage;
}}

if (!class_exists("FilterBooleanScalarOperator")) {
/**
 * FilterBooleanScalarOperator
 */
class FilterBooleanScalarOperator {
}}

if (!class_exists("FilterIdScalarOperator")) {
/**
 * FilterIdScalarOperator
 */
class FilterIdScalarOperator {
}}

if (!class_exists("FilterIntegerScalarOperator")) {
/**
 * FilterIntegerScalarOperator
 */
class FilterIntegerScalarOperator {
}}

if (!class_exists("FilterStringScalarOperator")) {
/**
 * FilterStringScalarOperator
 */
class FilterStringScalarOperator {
}}

if (!class_exists("FilterArrayOperator")) {
/**
 * FilterArrayOperator
 */
class FilterArrayOperator {
}}

if (!class_exists("FilterCondition")) {
/**
 * FilterCondition
 */
class FilterCondition {
}}

if (!class_exists("BooleanFilterCondition")) {
/**
 * BooleanFilterCondition
 */
class BooleanFilterCondition {
}}

if (!class_exists("ScalarBooleanFilterCondition")) {
/**
 * ScalarBooleanFilterCondition
 */
class ScalarBooleanFilterCondition extends BooleanFilterCondition {
    /**
     * @access public
     * @var boolean
     */
    public $value;
    /**
     * @access public
     * @var tnsFilterBooleanScalarOperator
     */
    public $operator;
}}

if (!class_exists("IntegerFilterCondition")) {
/**
 * IntegerFilterCondition
 */
class IntegerFilterCondition {
}}

if (!class_exists("ScalarIntegerFilterCondition")) {
/**
 * ScalarIntegerFilterCondition
 */
class ScalarIntegerFilterCondition extends IntegerFilterCondition {
    /**
     * @access public
     * @var integer
     */
    public $value;
    /**
     * @access public
     * @var tnsFilterIntegerScalarOperator
     */
    public $operator;
}}

if (!class_exists("ArrayIntegerFilterCondition")) {
/**
 * ArrayIntegerFilterCondition
 */
class ArrayIntegerFilterCondition extends IntegerFilterCondition {
    /**
     * @access public
     * @var integer[]
     */
    public $value;
    /**
     * @access public
     * @var tnsFilterArrayOperator
     */
    public $operator;
}}

if (!class_exists("IdFilterCondition")) {
/**
 * IdFilterCondition
 */
class IdFilterCondition {
}}

if (!class_exists("ScalarIdFilterCondition")) {
/**
 * ScalarIdFilterCondition
 */
class ScalarIdFilterCondition extends IdFilterCondition {
    /**
     * @access public
     * @var ObjectId
     */
    public $value;
    /**
     * @access public
     * @var tnsFilterIdScalarOperator
     */
    public $operator;
}}

if (!class_exists("ArrayIdFilterCondition")) {
/**
 * ArrayIdFilterCondition
 */
class ArrayIdFilterCondition extends IdFilterCondition {
    /**
     * @access public
     * @var ObjectId[]
     */
    public $value;
    /**
     * @access public
     * @var tnsFilterArrayOperator
     */
    public $operator;
}}

if (!class_exists("StringFilterCondition")) {
/**
 * StringFilterCondition
 */
class StringFilterCondition {
}}

if (!class_exists("ScalarStringFilterCondition")) {
/**
 * ScalarStringFilterCondition
 */
class ScalarStringFilterCondition extends StringFilterCondition {
    /**
     * @access public
     * @var string
     */
    public $value;
    /**
     * @access public
     * @var tnsFilterStringScalarOperator
     */
    public $operator;
}}

if (!class_exists("ArrayStringFilterCondition")) {
/**
 * ArrayStringFilterCondition
 */
class ArrayStringFilterCondition extends StringFilterCondition {
    /**
     * @access public
     * @var string[]
     */
    public $value;
    /**
     * @access public
     * @var tnsFilterArrayOperator
     */
    public $operator;
}}

if (!class_exists("ComparisonOperation")) {
/**
 * ComparisonOperation
 */
class ComparisonOperation {
}}

if (!class_exists("LogicalOperation")) {
/**
 * LogicalOperation
 */
class LogicalOperation {
}}

if (!class_exists("AddRecordsRequest")) {
/**
 * AddRecordsRequest
 */
class AddRecordsRequest {
}}

if (!class_exists("CopyRequest")) {
/**
 * CopyRequest
 */
class CopyRequest {
    /**
     * @access public
     * @var string
     */
    public $newName;
}}

if (!class_exists("CreateRequest")) {
/**
 * CreateRequest
 */
class CreateRequest {
    /**
     * @access public
     * @var BaseObject[]
     */
    public $baseObject;
}}

if (!class_exists("ExportRecordsRequest")) {
/**
 * ExportRecordsRequest
 */
class ExportRecordsRequest {
}}

if (!class_exists("DeleteRequest")) {
/**
 * DeleteRequest
 */
class DeleteRequest {
    /**
     * @access public
     * @var ObjectId[]
     */
    public $objectId;
}}

if (!class_exists("GetRequest")) {
/**
 * GetRequest
 */
class GetRequest {
    /**
     * @access public
     * @var ObjectId[]
     */
    public $objectId;
}}

if (!class_exists("Response")) {
/**
 * Response
 */
class Response {
}}

if (!class_exists("BatchResponse")) {
/**
 * BatchResponse
 */
class BatchResponse {
    /**
     * @access public
     * @var boolean[]
     */
    public $success;
    /**
     * @access public
     * @var FaultDetail[]
     */
    public $fault;
}}

if (!class_exists("BatchUpdateResponse")) {
/**
 * BatchUpdateResponse
 */
class BatchUpdateResponse extends BatchResponse {
    /**
     * @access public
     * @var UpdateResponse[]
     */
    public $updateResponse;
}}

if (!class_exists("GetStatisticsRequest")) {
/**
 * GetStatisticsRequest
 */
class GetStatisticsRequest {
}}

if (!class_exists("GetStatisticsResponse")) {
/**
 * GetStatisticsResponse
 */
class GetStatisticsResponse extends Response {
}}

if (!class_exists("ImportContentRequest")) {
/**
 * ImportContentRequest
 */
class ImportContentRequest {
    /**
     * @access public
     * @var base64Binary
     */
    public $content;
}}

if (!class_exists("ImportContentResponse")) {
/**
 * ImportContentResponse
 */
class ImportContentResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("ListRequest")) {
/**
 * ListRequest
 */
class ListRequest {
    /**
     * @access public
     * @var BaseFilter
     */
    public $filter;
}}

if (!class_exists("ListResponse")) {
/**
 * ListResponse
 */
class ListResponse extends Response {
    /**
     * @access public
     * @var ObjectId[]
     */
    public $objectId;
}}

if (!class_exists("RemoveRecordsRequest")) {
/**
 * RemoveRecordsRequest
 */
class RemoveRecordsRequest {
}}

if (!class_exists("RemoveRecordsResponse")) {
/**
 * RemoveRecordsResponse
 */
class RemoveRecordsResponse extends Response {
    /**
     * @access public
     * @var integer
     */
    public $recordsRemoved;
}}

if (!class_exists("TestRequest")) {
/**
 * TestRequest
 */
class TestRequest {
    /**
     * @access public
     * @var string[]
     */
    public $address;
    /**
     * @access public
     * @var tnsMessageFormat[]
     */
    public $format;
    /**
     * @access public
     * @var string
     */
    public $subjectPrefix;
    /**
     * @access public
     * @var SeedListId
     */
    public $testListId;
    /**
     * @access public
     * @var NameValuePair[]
     */
    public $tokenValue;
    /**
     * @access public
     * @var boolean
     */
    public $useMultiPart;
}}

if (!class_exists("TestResponse")) {
/**
 * TestResponse
 */
class TestResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("UpdateRequest")) {
/**
 * UpdateRequest
 */
class UpdateRequest {
    /**
     * @access public
     * @var BaseObject[]
     */
    public $baseObject;
}}

if (!class_exists("UpdateResponse")) {
/**
 * UpdateResponse
 */
class UpdateResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("CharSet")) {
/**
 * CharSet
 */
class CharSet {
}}

if (!class_exists("Encoding")) {
/**
 * Encoding
 */
class Encoding {
}}

if (!class_exists("FaultCode")) {
/**
 * FaultCode
 */
class FaultCode {
}}

if (!class_exists("FaultMessage")) {
/**
 * FaultMessage
 */
class FaultMessage {
}}

if (!class_exists("FaultDetail")) {
/**
 * FaultDetail
 */
class FaultDetail {
    /**
     * @access public
     * @var tnsFaultCode
     */
    public $faultCode;
    /**
     * @access public
     * @var tnsFaultMessage
     */
    public $faultMessage;
}}

if (!class_exists("AuthorizationFaultDetail")) {
/**
 * AuthorizationFaultDetail
 */
class AuthorizationFaultDetail extends FaultDetail {
}}

if (!class_exists("ConcurrentModificationFaultDetail")) {
/**
 * ConcurrentModificationFaultDetail
 */
class ConcurrentModificationFaultDetail extends FaultDetail {
}}

if (!class_exists("InvalidObjectFaultDetail")) {
/**
 * InvalidObjectFaultDetail
 */
class InvalidObjectFaultDetail extends FaultDetail {
}}

if (!class_exists("ObjectNotFoundFaultDetail")) {
/**
 * ObjectNotFoundFaultDetail
 */
class ObjectNotFoundFaultDetail extends FaultDetail {
}}

if (!class_exists("StaleObjectFaultDetail")) {
/**
 * StaleObjectFaultDetail
 */
class StaleObjectFaultDetail extends FaultDetail {
}}

if (!class_exists("UnexpectedFaultDetail")) {
/**
 * UnexpectedFaultDetail
 */
class UnexpectedFaultDetail extends FaultDetail {
}}

if (!class_exists("UnrecognizedObjectTypeFaultDetail")) {
/**
 * UnrecognizedObjectTypeFaultDetail
 */
class UnrecognizedObjectTypeFaultDetail extends FaultDetail {
}}

if (!class_exists("BadHandleFaultDetail")) {
/**
 * BadHandleFaultDetail
 */
class BadHandleFaultDetail extends FaultDetail {
}}

if (!class_exists("GetSingleSignOnURLResponse")) {
/**
 * GetSingleSignOnURLResponse
 */
class GetSingleSignOnURLResponse extends Response {
    /**
     * @access public
     * @var string
     */
    public $url;
}}

if (!class_exists("DataSourceId")) {
/**
 * DataSourceId
 */
class DataSourceId extends ObjectId {
}}

if (!class_exists("InternalDataSourceId")) {
/**
 * InternalDataSourceId
 */
class InternalDataSourceId extends DataSourceId {
}}

if (!class_exists("ExternalDataSourceId")) {
/**
 * ExternalDataSourceId
 */
class ExternalDataSourceId extends DataSourceId {
}}

if (!class_exists("DataSource")) {
/**
 * DataSource
 */
class DataSource extends BaseObject {
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var DataSourceField[]
     */
    public $field;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var tnsDataSourceOperationStatus
     */
    public $operationStatus;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("InternalDataSource")) {
/**
 * InternalDataSource
 */
class InternalDataSource extends DataSource {
}}

if (!class_exists("ExternalDataSource")) {
/**
 * ExternalDataSource
 */
class ExternalDataSource extends DataSource {
    /**
     * @access public
     * @var anyType
     */
    public $connectionInfo;
    /**
     * @access public
     * @var string
     */
    public $databaseName;
    /**
     * @access public
     * @var tnsDatabaseType
     */
    public $databaseType;
    /**
     * @access public
     * @var string
     */
    public $hostname;
    /**
     * @access public
     * @var string
     */
    public $password;
    /**
     * @access public
     * @var string
     */
    public $port;
    /**
     * @access public
     * @var string
     */
    public $username;
    /**
     * @access public
     * @var boolean
     */
    public $enableLocalCopy;
    /**
     * @access public
     * @var string
     */
    public $tableName;
    /**
     * @access public
     * @var boolean
     */
    public $allowRefreshAtLaunchTime;
    /**
     * @access public
     * @var anyType
     */
    public $hourlyRefresh;
    /**
     * @access public
     * @var tnsHourlyInterval
     */
    public $interval;
    /**
     * @access public
     * @var anyType
     */
    public $dailyRefresh;
    /**
     * @access public
     * @var time
     */
    public $startTime;
    /**
     * @access public
     * @var anyType
     */
    public $weeklyRefresh;
    /**
     * @access public
     * @var tnsDayOfWeek[]
     */
    public $day;
    /**
     * @access public
     * @var string
     */
    public $writebackTable;
    /**
     * @access public
     * @var string
     */
    public $advancedQuery;
    /**
     * @access public
     * @var string
     */
    public $sourceTableName;
}}

if (!class_exists("DataSourceFilter")) {
/**
 * DataSourceFilter
 */
class DataSourceFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $typeCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsDataSourceOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("AddDataSourceRecordsRequest")) {
/**
 * AddDataSourceRecordsRequest
 */
class AddDataSourceRecordsRequest extends AddRecordsRequest {
    /**
     * @access public
     * @var DataSourceId
     */
    public $dataSourceId;
    /**
     * @access public
     * @var boolean
     */
    public $containsFieldNames;
    /**
     * @access public
     * @var string
     */
    public $fieldDelimiter;
    /**
     * @access public
     * @var DataSourceRecord[]
     */
    public $dataSourceRecord;
    /**
     * @access public
     * @var string
     */
    public $ftpFileName;
    /**
     * @access public
     * @var base64Binary
     */
    public $dataSourceRecordsAttachment;
}}

if (!class_exists("RemoveDataSourceRecordsRequest")) {
/**
 * RemoveDataSourceRecordsRequest
 */
class RemoveDataSourceRecordsRequest extends RemoveRecordsRequest {
    /**
     * @access public
     * @var DataSourceId
     */
    public $dataSourceId;
    /**
     * @access public
     * @var string
     */
    public $matchFieldName;
    /**
     * @access public
     * @var string[]
     */
    public $record;
    /**
     * @access public
     * @var base64Binary
     */
    public $recordsAttachment;
}}

if (!class_exists("ExportDataSourceRecordsRequest")) {
/**
 * ExportDataSourceRecordsRequest
 */
class ExportDataSourceRecordsRequest extends ExportRecordsRequest {
    /**
     * @access public
     * @var DataSourceId
     */
    public $dataSourceId;
    /**
     * @access public
     * @var boolean
     */
    public $useMalformedRecords;
    /**
     * @access public
     * @var string
     */
    public $fieldDelimiter;
    /**
     * @access public
     * @var string
     */
    public $rowDelimiter;
}}

if (!class_exists("CopyDataSourceRequest")) {
/**
 * CopyDataSourceRequest
 */
class CopyDataSourceRequest extends CopyRequest {
    /**
     * @access public
     * @var InternalDataSourceId
     */
    public $fromId;
}}

if (!class_exists("DedupeDataSourceRecordsRequest")) {
/**
 * DedupeDataSourceRecordsRequest
 */
class DedupeDataSourceRecordsRequest extends DedupeRecordsRequest {
    /**
     * @access public
     * @var InternalDataSourceId
     */
    public $dataSourceId;
    /**
     * @access public
     * @var tnsDataSourceDedupeOption
     */
    public $option;
}}

if (!class_exists("DedupeRecordsResponse")) {
/**
 * DedupeRecordsResponse
 */
class DedupeRecordsResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("GetDataSourceStatisticsRequest")) {
/**
 * GetDataSourceStatisticsRequest
 */
class GetDataSourceStatisticsRequest extends GetStatisticsRequest {
    /**
     * @access public
     * @var DataSourceId
     */
    public $dataSourceId;
}}

if (!class_exists("GetDataSourceStatisticsResponse")) {
/**
 * GetDataSourceStatisticsResponse
 */
class GetDataSourceStatisticsResponse extends GetStatisticsResponse {
    /**
     * @access public
     * @var integer
     */
    public $totalInvalidRecords;
    /**
     * @access public
     * @var integer
     */
    public $totalMalformedRecords;
    /**
     * @access public
     * @var integer
     */
    public $totalRecords;
    /**
     * @access public
     * @var integer
     */
    public $totalUnsubscribedRecords;
    /**
     * @access public
     * @var dateTime
     */
    public $lastRefresh;
}}

if (!class_exists("RefreshRecordsResponse")) {
/**
 * RefreshRecordsResponse
 */
class RefreshRecordsResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("CancelRefreshRecordsResponse")) {
/**
 * CancelRefreshRecordsResponse
 */
class CancelRefreshRecordsResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("TargetId")) {
/**
 * TargetId
 */
class TargetId extends ObjectId {
}}

if (!class_exists("Target")) {
/**
 * Target
 */
class Target extends BaseObject {
    /**
     * @access public
     * @var string
     */
    public $advancedQuery;
    /**
     * @access public
     * @var string
     */
    public $bounceFieldName;
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var DataSourceId
     */
    public $dataSourceId;
    /**
     * @access public
     * @var string
     */
    public $emailAddressFieldName;
    /**
     * @access public
     * @var boolean
     */
    public $excludeBounce;
    /**
     * @access public
     * @var boolean
     */
    public $excludeUnsubscribe;
    /**
     * @access public
     * @var string
     */
    public $smsAddressFieldName;
    /**
     * @access public
     * @var integer
     */
    public $totalRecords;
    /**
     * @access public
     * @var tnsTargetType
     */
    public $type;
    /**
     * @access public
     * @var DataSourceId
     */
    public $retargetingDataSourceId;
    /**
     * @access public
     * @var string
     */
    public $unsubscribeFieldName;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("TargetFilter")) {
/**
 * TargetFilter
 */
class TargetFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $dataSourceIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $typeCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsTargetOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("CopyTargetRequest")) {
/**
 * CopyTargetRequest
 */
class CopyTargetRequest extends CopyRequest {
    /**
     * @access public
     * @var TargetId
     */
    public $fromId;
}}

if (!class_exists("ExportTargetRecordsRequest")) {
/**
 * ExportTargetRecordsRequest
 */
class ExportTargetRecordsRequest extends ExportRecordsRequest {
    /**
     * @access public
     * @var TargetId
     */
    public $targetId;
    /**
     * @access public
     * @var string
     */
    public $fieldDelimiter;
    /**
     * @access public
     * @var string
     */
    public $rowDelimiter;
}}

if (!class_exists("SuppressionListId")) {
/**
 * SuppressionListId
 */
class SuppressionListId extends ObjectId {
}}

if (!class_exists("SuppressionList")) {
/**
 * SuppressionList
 */
class SuppressionList extends BaseObject {
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var boolean
     */
    public $includeByDefaultOnMailings;
    /**
     * @access public
     * @var integer
     */
    public $totalRecords;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("SuppressionFilter")) {
/**
 * SuppressionFilter
 */
class SuppressionFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsSuppressionListOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("AddSuppressionListRecordsRequest")) {
/**
 * AddSuppressionListRecordsRequest
 */
class AddSuppressionListRecordsRequest extends AddRecordsRequest {
    /**
     * @access public
     * @var SuppressionListId
     */
    public $suppressionListId;
    /**
     * @access public
     * @var string[]
     */
    public $addressMatch;
    /**
     * @access public
     * @var base64Binary
     */
    public $addressMatchesAttachment;
}}

if (!class_exists("CopySuppressionListRequest")) {
/**
 * CopySuppressionListRequest
 */
class CopySuppressionListRequest extends CopyRequest {
    /**
     * @access public
     * @var SuppressionListId
     */
    public $fromId;
}}

if (!class_exists("ExportSuppressionListRecordsRequest")) {
/**
 * ExportSuppressionListRecordsRequest
 */
class ExportSuppressionListRecordsRequest extends ExportRecordsRequest {
    /**
     * @access public
     * @var SuppressionListId
     */
    public $suppressionListId;
}}

if (!class_exists("RemoveSuppressionListRecordsRequest")) {
/**
 * RemoveSuppressionListRecordsRequest
 */
class RemoveSuppressionListRecordsRequest extends RemoveRecordsRequest {
    /**
     * @access public
     * @var SuppressionListId
     */
    public $suppressionListId;
    /**
     * @access public
     * @var string[]
     */
    public $addressMatch;
    /**
     * @access public
     * @var base64Binary
     */
    public $addressMatchesAttachment;
}}

if (!class_exists("SeedListId")) {
/**
 * SeedListId
 */
class SeedListId extends ObjectId {
}}

if (!class_exists("SeedList")) {
/**
 * SeedList
 */
class SeedList extends BaseObject {
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var boolean
     */
    public $isTestList;
    /**
     * @access public
     * @var integer
     */
    public $totalRecords;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("SeedFilter")) {
/**
 * SeedFilter
 */
class SeedFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsSeedListOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("AddSeedListRecordsRequest")) {
/**
 * AddSeedListRecordsRequest
 */
class AddSeedListRecordsRequest extends AddRecordsRequest {
    /**
     * @access public
     * @var SeedListId
     */
    public $seedListId;
    /**
     * @access public
     * @var string[]
     */
    public $address;
    /**
     * @access public
     * @var base64Binary
     */
    public $addressesAttachment;
}}

if (!class_exists("CopySeedListRequest")) {
/**
 * CopySeedListRequest
 */
class CopySeedListRequest extends CopyRequest {
    /**
     * @access public
     * @var SeedListId
     */
    public $fromId;
}}

if (!class_exists("ExportSeedListRecordsRequest")) {
/**
 * ExportSeedListRecordsRequest
 */
class ExportSeedListRecordsRequest extends ExportRecordsRequest {
    /**
     * @access public
     * @var SeedListId
     */
    public $seedListId;
}}

if (!class_exists("RemoveSeedListRecordsRequest")) {
/**
 * RemoveSeedListRecordsRequest
 */
class RemoveSeedListRecordsRequest extends RemoveRecordsRequest {
    /**
     * @access public
     * @var SeedListId
     */
    public $seedListId;
    /**
     * @access public
     * @var string[]
     */
    public $address;
    /**
     * @access public
     * @var base64Binary
     */
    public $addressesAttachment;
}}

if (!class_exists("TemplateId")) {
/**
 * TemplateId
 */
class TemplateId extends ObjectId {
}}

if (!class_exists("Template")) {
/**
 * Template
 */
class Template extends BaseObject {
    /**
     * @access public
     * @var AttachmentId[]
     */
    public $attachmentId;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var tnsEncoding
     */
    public $bodyEncoding;
    /**
     * @access public
     * @var SystemAddressId
     */
    public $bounceAddressId;
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var ContentBlockId[]
     */
    public $contentBlockId;
    /**
     * @access public
     * @var SystemAddressId
     */
    public $fromAddressId;
    /**
     * @access public
     * @var string
     */
    public $fromName;
    /**
     * @access public
     * @var tnsEncoding
     */
    public $headerEncoding;
    /**
     * @access public
     * @var string[]
     */
    public $header;
    /**
     * @access public
     * @var boolean
     */
    public $isApproved;
    /**
     * @access public
     * @var MessagePart[]
     */
    public $messagePart;
    /**
     * @access public
     * @var tnsAssetExpiryInterval
     */
    public $assetExpiryInterval;
    /**
     * @access public
     * @var tnsCharSet
     */
    public $outputBodyCharSet;
    /**
     * @access public
     * @var tnsToken
     */
    public $outputBodyCharSetToken;
    /**
     * @access public
     * @var tnsCharSet
     */
    public $outputHeaderCharSet;
    /**
     * @access public
     * @var tnsToken
     */
    public $outputHeaderCharSetToken;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
    /**
     * @access public
     * @var SystemAddressId
     */
    public $replyAddressId;
    /**
     * @access public
     * @var string
     */
    public $subject;
    /**
     * @access public
     * @var string
     */
    public $forward2FriendOffer;
    /**
     * @access public
     * @var tnsForward2FriendOfferTrackingOption
     */
    public $forward2FriendOfferTrackingOption;
}}

if (!class_exists("TemplateFilter")) {
/**
 * TemplateFilter
 */
class TemplateFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarBooleanFilterCondition
     */
    public $approvalCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsTemplateOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("CopyTemplateRequest")) {
/**
 * CopyTemplateRequest
 */
class CopyTemplateRequest extends CopyRequest {
    /**
     * @access public
     * @var TemplateId
     */
    public $fromId;
    /**
     * @access public
     * @var OrganizationId
     */
    public $newOrganizationId;
}}

if (!class_exists("ImportMessagePartResponse")) {
/**
 * ImportMessagePartResponse
 */
class ImportMessagePartResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("TestTemplateRequest")) {
/**
 * TestTemplateRequest
 */
class TestTemplateRequest extends TestRequest {
    /**
     * @access public
     * @var TemplateId
     */
    public $templateId;
}}

if (!class_exists("ValidateXslResponse")) {
/**
 * ValidateXslResponse
 */
class ValidateXslResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $valid;
}}

if (!class_exists("FetchLinkResponse")) {
/**
 * FetchLinkResponse
 */
class FetchLinkResponse extends Response {
    /**
     * @access public
     * @var NamedLink
     */
    public $namedLink;
}}

if (!class_exists("FetchLinksResponse")) {
/**
 * FetchLinksResponse
 */
class FetchLinksResponse extends BatchResponse {
    /**
     * @access public
     * @var FetchLinkResponse[]
     */
    public $fetchLinkResponse;
}}

if (!class_exists("ContentBlockId")) {
/**
 * ContentBlockId
 */
class ContentBlockId extends ObjectId {
}}

if (!class_exists("ContentBlock")) {
/**
 * ContentBlock
 */
class ContentBlock extends BaseObject {
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var string
     */
    public $content;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
    /**
     * @access public
     * @var integer
     */
    public $size;
    /**
     * @access public
     * @var NamedLink[]
     */
    public $namedLinks;
}}

if (!class_exists("ContentBlockFilter")) {
/**
 * ContentBlockFilter
 */
class ContentBlockFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsContentBlockOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("CopyContentBlockRequest")) {
/**
 * CopyContentBlockRequest
 */
class CopyContentBlockRequest extends CopyRequest {
    /**
     * @access public
     * @var ContentBlockId
     */
    public $fromId;
    /**
     * @access public
     * @var OrganizationId
     */
    public $newOrganizationId;
}}

if (!class_exists("AttachmentId")) {
/**
 * AttachmentId
 */
class AttachmentId extends ObjectId {
}}

if (!class_exists("Attachment")) {
/**
 * Attachment
 */
class Attachment extends BaseObject {
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var base64Binary
     */
    public $content;
    /**
     * @access public
     * @var string
     */
    public $fileName;
    /**
     * @access public
     * @var string
     */
    public $fileReference;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
    /**
     * @access public
     * @var integer
     */
    public $size;
}}

if (!class_exists("AttachmentFilter")) {
/**
 * AttachmentFilter
 */
class AttachmentFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsAttachmentOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("ImportAttachmentContentRequest")) {
/**
 * ImportAttachmentContentRequest
 */
class ImportAttachmentContentRequest extends ImportContentRequest {
    /**
     * @access public
     * @var AttachmentId
     */
    public $attachmentId;
    /**
     * @access public
     * @var string
     */
    public $fileName;
}}

if (!class_exists("RuleId")) {
/**
 * RuleId
 */
class RuleId extends ObjectId {
}}

if (!class_exists("Rule")) {
/**
 * Rule
 */
class Rule extends BaseObject {
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var TargetId[]
     */
    public $targetId;
    /**
     * @access public
     * @var RuleIfPart
     */
    public $ifPart;
    /**
     * @access public
     * @var RuleThenPart
     */
    public $thenPart;
    /**
     * @access public
     * @var RuleElsePart
     */
    public $elsePart;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("RuleFilter")) {
/**
 * RuleFilter
 */
class RuleFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var tnsRuleOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("CopyRuleRequest")) {
/**
 * CopyRuleRequest
 */
class CopyRuleRequest extends CopyRequest {
    /**
     * @access public
     * @var RuleId
     */
    public $fromId;
}}

if (!class_exists("MailingId")) {
/**
 * MailingId
 */
class MailingId extends ObjectId {
}}

if (!class_exists("StandardMailingId")) {
/**
 * StandardMailingId
 */
class StandardMailingId extends MailingId {
}}

if (!class_exists("TransactionalMailingId")) {
/**
 * TransactionalMailingId
 */
class TransactionalMailingId extends MailingId {
}}

if (!class_exists("Mailing")) {
/**
 * Mailing
 */
class Mailing extends BaseObject {
    /**
     * @access public
     * @var AttachmentId[]
     */
    public $attachmentId;
    /**
     * @access public
     * @var tnsEncoding
     */
    public $bodyEncoding;
    /**
     * @access public
     * @var SystemAddressId
     */
    public $bounceAddressId;
    /**
     * @access public
     * @var CampaignId
     */
    public $campaignId;
    /**
     * @access public
     * @var boolean
     */
    public $isApproved;
    /**
     * @access public
     * @var boolean
     */
    public $isCompliant;
    /**
     * @access public
     * @var ContentBlockId[]
     */
    public $contentBlockId;
    /**
     * @access public
     * @var string
     */
    public $fieldDelimiter;
    /**
     * @access public
     * @var tnsMessageFormat[]
     */
    public $format;
    /**
     * @access public
     * @var SystemAddressId
     */
    public $fromAddressId;
    /**
     * @access public
     * @var string
     */
    public $fromName;
    /**
     * @access public
     * @var tnsEncoding
     */
    public $headerEncoding;
    /**
     * @access public
     * @var string[]
     */
    public $header;
    /**
     * @access public
     * @var tnsMailingStatus
     */
    public $lastGoodStatus;
    /**
     * @access public
     * @var MailingClassId
     */
    public $mailingClassId;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var tnsMailingPriority
     */
    public $priority;
    /**
     * @access public
     * @var tnsCharSet
     */
    public $outputBodyCharSet;
    /**
     * @access public
     * @var tnsToken
     */
    public $outputBodyCharSetToken;
    /**
     * @access public
     * @var tnsCharSet
     */
    public $outputHeaderCharSet;
    /**
     * @access public
     * @var tnsToken
     */
    public $outputHeaderCharSetToken;
    /**
     * @access public
     * @var MailingId
     */
    public $parentId;
    /**
     * @access public
     * @var date
     */
    public $plannedLaunchDate;
    /**
     * @access public
     * @var SystemAddressId
     */
    public $replyAddressId;
    /**
     * @access public
     * @var string
     */
    public $rowDelimiter;
    /**
     * @access public
     * @var integer
     */
    public $serverErrorCode;
    /**
     * @access public
     * @var string
     */
    public $serverErrorMessage;
    /**
     * @access public
     * @var tnsMailingStatus
     */
    public $status;
    /**
     * @access public
     * @var string
     */
    public $subject;
    /**
     * @access public
     * @var TemplateId
     */
    public $templateId;
    /**
     * @access public
     * @var tnsMailingType
     */
    public $type;
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
    /**
     * @access public
     * @var string
     */
    public $forward2FriendOffer;
    /**
     * @access public
     * @var tnsForward2FriendOfferTrackingOption
     */
    public $forward2FriendOfferTrackingOption;
}}

if (!class_exists("SchedulableMailing")) {
/**
 * SchedulableMailing
 */
class SchedulableMailing extends Mailing {
    /**
     * @access public
     * @var anyType
     */
    public $schedule;
    /**
     * @access public
     * @var dateTime
     */
    public $startDateTime;
    /**
     * @access public
     * @var anyType
     */
    public $recurrence;
    /**
     * @access public
     * @var date
     */
    public $endDate;
    /**
     * @access public
     * @var integer
     */
    public $endAfterXMailings;
    /**
     * @access public
     * @var anyType
     */
    public $minutelyRecurrence;
    /**
     * @access public
     * @var tnsMinutelyInterval
     */
    public $interval;
    /**
     * @access public
     * @var anyType
     */
    public $hourlyRecurrence;
    /**
     * @access public
     * @var anyType
     */
    public $dailyRecurrence;
    /**
     * @access public
     * @var boolean
     */
    public $everyWeekDay;
    /**
     * @access public
     * @var anyType
     */
    public $weeklyRecurrence;
    /**
     * @access public
     * @var tnsDayOfWeek[]
     */
    public $day;
    /**
     * @access public
     * @var anyType
     */
    public $monthlyByDateRecurrence;
    /**
     * @access public
     * @var tnsDayOfMonth[]
     */
    public $dayOfMonth;
    /**
     * @access public
     * @var anyType
     */
    public $monthlyByDayRecurrence;
    /**
     * @access public
     * @var tnsWeeklyOccurrence
     */
    public $weeklyOccurrence;
    /**
     * @access public
     * @var tnsDailyOccurrence
     */
    public $dailyOccurrence;
    /**
     * @access public
     * @var anyType
     */
    public $yearlyByDateRecurrence;
    /**
     * @access public
     * @var tnsMonth
     */
    public $month;
    /**
     * @access public
     * @var anyType
     */
    public $yearlyByDayRecurrence;
    /**
     * @access public
     * @var dateTime
     */
    public $nextScheduledDateTime;
}}

if (!class_exists("StandardMailing")) {
/**
 * StandardMailing
 */
class StandardMailing extends SchedulableMailing {
    /**
     * @access public
     * @var boolean
     */
    public $eliminateDuplicates;
    /**
     * @access public
     * @var TargetId[]
     */
    public $excludedTargetId;
    /**
     * @access public
     * @var TargetId[]
     */
    public $includedTargetId;
    /**
     * @access public
     * @var SeedListId[]
     */
    public $seedListId;
    /**
     * @access public
     * @var SuppressionListId[]
     */
    public $suppressionListId;
    /**
     * @access public
     * @var tnsAssetExpiryInterval
     */
    public $assetExpiryInterval;
}}

if (!class_exists("TransactionalMailing")) {
/**
 * TransactionalMailing
 */
class TransactionalMailing extends Mailing {
    /**
     * @access public
     * @var string
     */
    public $formatFieldName;
    /**
     * @access public
     * @var string
     */
    public $mailingConfig;
    /**
     * @access public
     * @var tnsMessageType
     */
    public $messageType;
    /**
     * @access public
     * @var string[]
     */
    public $recordStructure;
    /**
     * @access public
     * @var string
     */
    public $senderNumber;
    /**
     * @access public
     * @var TargetId
     */
    public $targetId;
}}

if (!class_exists("MailingFilter")) {
/**
 * MailingFilter
 */
class MailingFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $campaignIdCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var ArrayStringFilterCondition
     */
    public $typeCondition;
    /**
     * @access public
     * @var ArrayStringFilterCondition
     */
    public $statusCondition;
    /**
     * @access public
     * @var tnsMailingOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("CopyMailingRequest")) {
/**
 * CopyMailingRequest
 */
class CopyMailingRequest extends CopyRequest {
    /**
     * @access public
     * @var MailingId
     */
    public $fromId;
}}

if (!class_exists("CancelResponse")) {
/**
 * CancelResponse
 */
class CancelResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("CloseResponse")) {
/**
 * CloseResponse
 */
class CloseResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("ArchiveResponse")) {
/**
 * ArchiveResponse
 */
class ArchiveResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("GetMailingStatisticsRequest")) {
/**
 * GetMailingStatisticsRequest
 */
class GetMailingStatisticsRequest extends GetStatisticsRequest {
    /**
     * @access public
     * @var MailingId
     */
    public $mailingId;
}}

if (!class_exists("GetMailingStatisticsResponse")) {
/**
 * GetMailingStatisticsResponse
 */
class GetMailingStatisticsResponse extends GetStatisticsResponse {
    /**
     * @access public
     * @var string
     */
    public $launchSerial;
    /**
     * @access public
     * @var duration
     */
    public $elapsedTime;
    /**
     * @access public
     * @var dateTime
     */
    public $launchTime;
    /**
     * @access public
     * @var dateTime
     */
    public $completionTime;
    /**
     * @access public
     * @var integer
     */
    public $deferred;
    /**
     * @access public
     * @var integer
     */
    public $delivered;
    /**
     * @access public
     * @var integer
     */
    public $failed;
    /**
     * @access public
     * @var integer
     */
    public $invalid;
    /**
     * @access public
     * @var integer
     */
    public $sent;
    /**
     * @access public
     * @var integer
     */
    public $targeted;
    /**
     * @access public
     * @var integer
     */
    public $totalClicks;
    /**
     * @access public
     * @var integer
     */
    public $totalComplaints;
    /**
     * @access public
     * @var integer
     */
    public $totalOpens;
    /**
     * @access public
     * @var integer
     */
    public $totalUnsubscribes;
    /**
     * @access public
     * @var integer
     */
    public $uniqueClicks;
    /**
     * @access public
     * @var integer
     */
    public $uniqueComplaints;
    /**
     * @access public
     * @var integer
     */
    public $uniqueOpens;
    /**
     * @access public
     * @var integer
     */
    public $uniqueUnsubscribes;
}}

if (!class_exists("LaunchResponse")) {
/**
 * LaunchResponse
 */
class LaunchResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("LoadResponse")) {
/**
 * LoadResponse
 */
class LoadResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("PauseResponse")) {
/**
 * PauseResponse
 */
class PauseResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("ResumeResponse")) {
/**
 * ResumeResponse
 */
class ResumeResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("ScheduleResponse")) {
/**
 * ScheduleResponse
 */
class ScheduleResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("SendResponse")) {
/**
 * SendResponse
 */
class SendResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("GetTxnMailingHandleResponse")) {
/**
 * GetTxnMailingHandleResponse
 */
class GetTxnMailingHandleResponse extends Response {
    /**
     * @access public
     * @var string
     */
    public $handle;
}}

if (!class_exists("TxnSendResponse")) {
/**
 * TxnSendResponse
 */
class TxnSendResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("GetTxnEasInfoResponse")) {
/**
 * GetTxnEasInfoResponse
 */
class GetTxnEasInfoResponse extends Response {
    /**
     * @access public
     * @var string
     */
    public $hostname;
    /**
     * @access public
     * @var string
     */
    public $mailingName;
    /**
     * @access public
     * @var string
     */
    public $mailingHandle;
}}

if (!class_exists("TestMailingRequest")) {
/**
 * TestMailingRequest
 */
class TestMailingRequest extends TestRequest {
    /**
     * @access public
     * @var StandardMailingId
     */
    public $mailingId;
}}

if (!class_exists("OrganizationId")) {
/**
 * OrganizationId
 */
class OrganizationId extends ObjectId {
}}

if (!class_exists("Organization")) {
/**
 * Organization
 */
class Organization extends BaseObject {
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var base64Binary
     */
    public $logo;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $parentId;
    /**
     * @access public
     * @var string
     */
    public $viewInBrowserExceptionURL;
    /**
     * @access public
     * @var string
     */
    public $forward2FriendExceptionURL;
    /**
     * @access public
     * @var string
     */
    public $socialNotesExceptionURL;
    /**
     * @access public
     * @var string
     */
    public $socialNotesWidget;
    /**
     * @access public
     * @var string
     */
    public $forward2FriendOffer;
    /**
     * @access public
     * @var tnsForward2FriendOfferTrackingOption
     */
    public $forward2FriendOfferTrackingOption;
    /**
     * @access public
     * @var string
     */
    public $influencerSecretKey;
    /**
     * @access public
     * @var string
     */
    public $influencerClientUuid;
}}

if (!class_exists("OrganizationFilter")) {
/**
 * OrganizationFilter
 */
class OrganizationFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $parentIdCondition;
    /**
     * @access public
     * @var tnsOrganizationOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("UserId")) {
/**
 * UserId
 */
class UserId extends ObjectId {
}}

if (!class_exists("User")) {
/**
 * User
 */
class User extends BaseObject {
    /**
     * @access public
     * @var anyType[]
     */
    public $access;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var RoleId
     */
    public $roleId;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $email;
    /**
     * @access public
     * @var string
     */
    public $firstName;
    /**
     * @access public
     * @var boolean
     */
    public $isAdmin;
    /**
     * @access public
     * @var boolean
     */
    public $isSuperUser;
    /**
     * @access public
     * @var string
     */
    public $lastName;
    /**
     * @access public
     * @var string
     */
    public $login;
    /**
     * @access public
     * @var string
     */
    public $password;
}}

if (!class_exists("UserFilter")) {
/**
 * UserFilter
 */
class UserFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarBooleanFilterCondition
     */
    public $isAdminCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $loginNameCondition;
    /**
     * @access public
     * @var tnsUserOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("RoleId")) {
/**
 * RoleId
 */
class RoleId extends ObjectId {
}}

if (!class_exists("Role")) {
/**
 * Role
 */
class Role extends BaseObject {
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var Permissions
     */
    public $permissions;
}}

if (!class_exists("RoleFilter")) {
/**
 * RoleFilter
 */
class RoleFilter extends BaseFilter {
    /**
     * @access public
     * @var tnsRoleOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("AssignedRoleId")) {
/**
 * AssignedRoleId
 */
class AssignedRoleId extends ObjectId {
}}

if (!class_exists("AssignedRole")) {
/**
 * AssignedRole
 */
class AssignedRole extends BaseObject {
    /**
     * @access public
     * @var RoleId
     */
    public $roleId;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $userId;
}}

if (!class_exists("AssignedRoleFilter")) {
/**
 * AssignedRoleFilter
 */
class AssignedRoleFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $roleIdCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $organizationIdCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsAssignedRoleOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("SystemAddressId")) {
/**
 * SystemAddressId
 */
class SystemAddressId extends ObjectId {
}}

if (!class_exists("SystemAddress")) {
/**
 * SystemAddress
 */
class SystemAddress extends BaseObject {
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $emailAddress;
    /**
     * @access public
     * @var boolean
     */
    public $isBounce;
    /**
     * @access public
     * @var string
     */
    public $fromName;
    /**
     * @access public
     * @var boolean
     */
    public $isFrom;
    /**
     * @access public
     * @var boolean
     */
    public $isReply;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("SystemAddressFilter")) {
/**
 * SystemAddressFilter
 */
class SystemAddressFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $typeCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsSystemAddressOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("CampaignId")) {
/**
 * CampaignId
 */
class CampaignId extends ObjectId {
}}

if (!class_exists("Campaign")) {
/**
 * Campaign
 */
class Campaign extends BaseObject {
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("CampaignFilter")) {
/**
 * CampaignFilter
 */
class CampaignFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsCampaignOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("MediaServerId")) {
/**
 * MediaServerId
 */
class MediaServerId extends ObjectId {
}}

if (!class_exists("MediaServer")) {
/**
 * MediaServer
 */
class MediaServer extends BaseObject {
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var anyURI
     */
    public $defaultUrl;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var boolean
     */
    public $isWritable;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
    /**
     * @access public
     * @var anyType[]
     */
    public $server;
    /**
     * @access public
     * @var string
     */
    public $defaultImagePath;
    /**
     * @access public
     * @var string
     */
    public $host;
    /**
     * @access public
     * @var string
     */
    public $login;
    /**
     * @access public
     * @var string
     */
    public $password;
    /**
     * @access public
     * @var integer
     */
    public $sshPort;
}}

if (!class_exists("MediaServerFilter")) {
/**
 * MediaServerFilter
 */
class MediaServerFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $urlCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var ScalarBooleanFilterCondition
     */
    public $writableCondition;
    /**
     * @access public
     * @var tnsMediaServerOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("WebAnalyticsId")) {
/**
 * WebAnalyticsId
 */
class WebAnalyticsId extends ObjectId {
}}

if (!class_exists("WebAnalytics")) {
/**
 * WebAnalytics
 */
class WebAnalytics extends BaseObject {
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
    /**
     * @access public
     * @var NameValuePair[]
     */
    public $parameter;
}}

if (!class_exists("WebAnalyticsFilter")) {
/**
 * WebAnalyticsFilter
 */
class WebAnalyticsFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsWebAnalyticsOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("MailingClassId")) {
/**
 * MailingClassId
 */
class MailingClassId extends ObjectId {
}}

if (!class_exists("MailingClass")) {
/**
 * MailingClass
 */
class MailingClass extends BaseObject {
    /**
     * @access public
     * @var dateTime
     */
    public $createdTime;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var OrganizationId[]
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("MailingClassFilter")) {
/**
 * MailingClassFilter
 */
class MailingClassFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarIdFilterCondition
     */
    public $userIdCondition;
    /**
     * @access public
     * @var tnsMailingClassOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("StrongtoolId")) {
/**
 * StrongtoolId
 */
class StrongtoolId extends ObjectId {
}}

if (!class_exists("Strongtool")) {
/**
 * Strongtool
 */
class Strongtool extends BaseObject {
    /**
     * @access public
     * @var string
     */
    public $name;
    /**
     * @access public
     * @var string
     */
    public $description;
    /**
     * @access public
     * @var string
     */
    public $url;
    /**
     * @access public
     * @var tnsStrongtoolOpenAs
     */
    public $openAs;
    /**
     * @access public
     * @var OrganizationId
     */
    public $organizationId;
    /**
     * @access public
     * @var UserId
     */
    public $ownerId;
}}

if (!class_exists("StrongtoolFilter")) {
/**
 * StrongtoolFilter
 */
class StrongtoolFilter extends BaseFilter {
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $nameCondition;
    /**
     * @access public
     * @var ScalarStringFilterCondition
     */
    public $openAsCondition;
    /**
     * @access public
     * @var tnsStrongtoolOrderBy[]
     */
    public $orderBy;
}}

if (!class_exists("AddRecordsResponse")) {
/**
 * AddRecordsResponse
 */
class AddRecordsResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("CopyResponse")) {
/**
 * CopyResponse
 */
class CopyResponse extends Response {
    /**
     * @access public
     * @var ObjectId
     */
    public $objectId;
}}

if (!class_exists("BatchCreateResponse")) {
/**
 * BatchCreateResponse
 */
class BatchCreateResponse extends BatchResponse {
    /**
     * @access public
     * @var CreateResponse[]
     */
    public $createResponse;
}}

if (!class_exists("CreateResponse")) {
/**
 * CreateResponse
 */
class CreateResponse extends Response {
    /**
     * @access public
     * @var ObjectId
     */
    public $objectId;
}}

if (!class_exists("ExportRecordsResponse")) {
/**
 * ExportRecordsResponse
 */
class ExportRecordsResponse extends Response {
    /**
     * @access public
     * @var base64Binary
     */
    public $data;
}}

if (!class_exists("BatchDeleteResponse")) {
/**
 * BatchDeleteResponse
 */
class BatchDeleteResponse extends BatchResponse {
    /**
     * @access public
     * @var DeleteResponse[]
     */
    public $deleteResponse;
}}

if (!class_exists("DeleteResponse")) {
/**
 * DeleteResponse
 */
class DeleteResponse extends Response {
    /**
     * @access public
     * @var boolean
     */
    public $success;
}}

if (!class_exists("BatchGetResponse")) {
/**
 * BatchGetResponse
 */
class BatchGetResponse extends BatchResponse {
    /**
     * @access public
     * @var GetResponse[]
     */
    public $getResponse;
}}

if (!class_exists("GetResponse")) {
/**
 * GetResponse
 */
class GetResponse extends Response {
    /**
     * @access public
     * @var BaseObject
     */
    public $baseObject;
}}

if (!class_exists("MailingService")) {
/**
 * MailingService
 * @author WSDLInterpreter
 */
class MailingService extends SoapClient {
    /**
     * Default class map for wsdl=>php
     * @access private
     * @var array
     */
    private static $classmap = array(
        "GetSingleSignOnURLRequest" => "GetSingleSignOnURLRequest",
        "GetSingleSignOnURLResponse" => "GetSingleSignOnURLResponse",
        "Response" => "Response",
        "DataSourceId" => "DataSourceId",
        "ObjectId" => "ObjectId",
        "InternalDataSourceId" => "InternalDataSourceId",
        "ExternalDataSourceId" => "ExternalDataSourceId",
        "DataSource" => "DataSource",
        "BaseObject" => "BaseObject",
        "InternalDataSource" => "InternalDataSource",
        "ExternalDataSource" => "ExternalDataSource",
        "connectionInfo" => "connectionInfo",
        "hourlyRefresh" => "hourlyRefresh",
        "dailyRefresh" => "dailyRefresh",
        "weeklyRefresh" => "weeklyRefresh",
        "DataSourceType" => "DataSourceType",
        "DatabaseType" => "DatabaseType",
        "DataSourceField" => "DataSourceField",
        "DataSourceFieldType" => "DataSourceFieldType",
        "DataSourceDataType" => "DataSourceDataType",
        "DataSourceRecord" => "DataSourceRecord",
        "DataSourceOperationStatus" => "DataSourceOperationStatus",
        "DataSourceDedupeOption" => "DataSourceDedupeOption",
        "DataSourceFilter" => "DataSourceFilter",
        "BaseFilter" => "BaseFilter",
        "DataSourceOrderBy" => "DataSourceOrderBy",
        "AddDataSourceRecordsRequest" => "AddDataSourceRecordsRequest",
        "AddRecordsRequest" => "AddRecordsRequest",
        "RemoveDataSourceRecordsRequest" => "RemoveDataSourceRecordsRequest",
        "RemoveRecordsRequest" => "RemoveRecordsRequest",
        "ExportDataSourceRecordsRequest" => "ExportDataSourceRecordsRequest",
        "ExportRecordsRequest" => "ExportRecordsRequest",
        "CopyDataSourceRequest" => "CopyDataSourceRequest",
        "CopyRequest" => "CopyRequest",
        "DedupeDataSourceRecordsRequest" => "DedupeDataSourceRecordsRequest",
        "DedupeRecordsRequest" => "DedupeRecordsRequest",
        "DedupeRecordsResponse" => "DedupeRecordsResponse",
        "GetDataSourceStatisticsRequest" => "GetDataSourceStatisticsRequest",
        "GetStatisticsRequest" => "GetStatisticsRequest",
        "GetDataSourceStatisticsResponse" => "GetDataSourceStatisticsResponse",
        "GetStatisticsResponse" => "GetStatisticsResponse",
        "RefreshRecordsRequest" => "RefreshRecordsRequest",
        "RefreshRecordsResponse" => "RefreshRecordsResponse",
        "CancelRefreshRecordsRequest" => "CancelRefreshRecordsRequest",
        "CancelRefreshRecordsResponse" => "CancelRefreshRecordsResponse",
        "TargetId" => "TargetId",
        "Target" => "Target",
        "TargetType" => "TargetType",
        "TargetFilter" => "TargetFilter",
        "TargetOrderBy" => "TargetOrderBy",
        "CopyTargetRequest" => "CopyTargetRequest",
        "ExportTargetRecordsRequest" => "ExportTargetRecordsRequest",
        "SuppressionListId" => "SuppressionListId",
        "SuppressionList" => "SuppressionList",
        "SuppressionFilter" => "SuppressionFilter",
        "SuppressionListOrderBy" => "SuppressionListOrderBy",
        "AddSuppressionListRecordsRequest" => "AddSuppressionListRecordsRequest",
        "CopySuppressionListRequest" => "CopySuppressionListRequest",
        "ExportSuppressionListRecordsRequest" => "ExportSuppressionListRecordsRequest",
        "RemoveSuppressionListRecordsRequest" => "RemoveSuppressionListRecordsRequest",
        "SeedListId" => "SeedListId",
        "SeedList" => "SeedList",
        "SeedFilter" => "SeedFilter",
        "SeedListOrderBy" => "SeedListOrderBy",
        "AddSeedListRecordsRequest" => "AddSeedListRecordsRequest",
        "CopySeedListRequest" => "CopySeedListRequest",
        "ExportSeedListRecordsRequest" => "ExportSeedListRecordsRequest",
        "RemoveSeedListRecordsRequest" => "RemoveSeedListRecordsRequest",
        "TemplateId" => "TemplateId",
        "Template" => "Template",
        "TrackingTag" => "TrackingTag",
        "OpenTag" => "OpenTag",
        "TrackingTagProperties" => "TrackingTagProperties",
        "NamedLink" => "NamedLink",
        "MessagePart" => "MessagePart",
        "MessageFormat" => "MessageFormat",
        "MessageType" => "MessageType",
        "TemplateFilter" => "TemplateFilter",
        "TemplateOrderBy" => "TemplateOrderBy",
        "CopyTemplateRequest" => "CopyTemplateRequest",
        "ImportMessagePartRequest" => "ImportMessagePartRequest",
        "ImportMessagePartResponse" => "ImportMessagePartResponse",
        "TestTemplateRequest" => "TestTemplateRequest",
        "TestRequest" => "TestRequest",
        "ValidateXslRequest" => "ValidateXslRequest",
        "ValidateXslResponse" => "ValidateXslResponse",
        "FetchLinksRequest" => "FetchLinksRequest",
        "FetchLinkResponse" => "FetchLinkResponse",
        "FetchLinksResponse" => "FetchLinksResponse",
        "BatchResponse" => "BatchResponse",
        "FetchLinksTemplateRequest" => "FetchLinksTemplateRequest",
        "ContentBlockId" => "ContentBlockId",
        "ContentBlock" => "ContentBlock",
        "ContentBlockToken" => "ContentBlockToken",
        "ContentBlockFilter" => "ContentBlockFilter",
        "ContentBlockOrderBy" => "ContentBlockOrderBy",
        "CopyContentBlockRequest" => "CopyContentBlockRequest",
        "FetchLinksContentBlockRequest" => "FetchLinksContentBlockRequest",
        "AttachmentId" => "AttachmentId",
        "Attachment" => "Attachment",
        "AttachmentFilter" => "AttachmentFilter",
        "AttachmentOrderBy" => "AttachmentOrderBy",
        "ImportAttachmentContentRequest" => "ImportAttachmentContentRequest",
        "ImportContentRequest" => "ImportContentRequest",
        "RuleId" => "RuleId",
        "Rule" => "Rule",
        "RuleValue" => "RuleValue",
        "ColumnRuleValue" => "ColumnRuleValue",
        "ContentBlockTokenRuleValue" => "ContentBlockTokenRuleValue",
        "TextRuleValue" => "TextRuleValue",
        "NestedRuleRuleValue" => "NestedRuleRuleValue",
        "RuleIfPartCondition" => "RuleIfPartCondition",
        "RuleIfPart" => "RuleIfPart",
        "RuleThenPart" => "RuleThenPart",
        "RuleElsePart" => "RuleElsePart",
        "RuleFilter" => "RuleFilter",
        "RuleOrderBy" => "RuleOrderBy",
        "CopyRuleRequest" => "CopyRuleRequest",
        "MailingId" => "MailingId",
        "StandardMailingId" => "StandardMailingId",
        "TransactionalMailingId" => "TransactionalMailingId",
        "Mailing" => "Mailing",
        "SchedulableMailing" => "SchedulableMailing",
        "schedule" => "schedule",
        "recurrence" => "recurrence",
        "minutelyRecurrence" => "minutelyRecurrence",
        "hourlyRecurrence" => "hourlyRecurrence",
        "dailyRecurrence" => "dailyRecurrence",
        "weeklyRecurrence" => "weeklyRecurrence",
        "monthlyByDateRecurrence" => "monthlyByDateRecurrence",
        "monthlyByDayRecurrence" => "monthlyByDayRecurrence",
        "yearlyByDateRecurrence" => "yearlyByDateRecurrence",
        "yearlyByDayRecurrence" => "yearlyByDayRecurrence",
        "StandardMailing" => "StandardMailing",
        "TransactionalMailing" => "TransactionalMailing",
        "MailingStatus" => "MailingStatus",
        "MailingType" => "MailingType",
        "MailingPriority" => "MailingPriority",
        "MinutelyInterval" => "MinutelyInterval",
        "HourlyInterval" => "HourlyInterval",
        "DailyInterval" => "DailyInterval",
        "WeeklyInterval" => "WeeklyInterval",
        "MonthlyInterval" => "MonthlyInterval",
        "DailyOccurrence" => "DailyOccurrence",
        "WeeklyOccurrence" => "WeeklyOccurrence",
        "MailingFilter" => "MailingFilter",
        "MailingOrderBy" => "MailingOrderBy",
        "AssetExpiryInterval" => "AssetExpiryInterval",
        "CopyMailingRequest" => "CopyMailingRequest",
        "CancelRequest" => "CancelRequest",
        "CancelResponse" => "CancelResponse",
        "CloseRequest" => "CloseRequest",
        "CloseResponse" => "CloseResponse",
        "ArchiveRequest" => "ArchiveRequest",
        "ArchiveResponse" => "ArchiveResponse",
        "GetMailingStatisticsRequest" => "GetMailingStatisticsRequest",
        "GetMailingStatisticsResponse" => "GetMailingStatisticsResponse",
        "LaunchRequest" => "LaunchRequest",
        "LaunchResponse" => "LaunchResponse",
        "LoadRequest" => "LoadRequest",
        "LoadResponse" => "LoadResponse",
        "PauseRequest" => "PauseRequest",
        "PauseResponse" => "PauseResponse",
        "ResumeRequest" => "ResumeRequest",
        "ResumeResponse" => "ResumeResponse",
        "ScheduleRequest" => "ScheduleRequest",
        "ScheduleResponse" => "ScheduleResponse",
        "SendRecord" => "SendRecord",
        "SendRequest" => "SendRequest",
        "SendResponse" => "SendResponse",
        "GetTxnMailingHandleRequest" => "GetTxnMailingHandleRequest",
        "GetTxnMailingHandleResponse" => "GetTxnMailingHandleResponse",
        "TxnSendRequest" => "TxnSendRequest",
        "TxnSendResponse" => "TxnSendResponse",
        "GetTxnEasInfoRequest" => "GetTxnEasInfoRequest",
        "GetTxnEasInfoResponse" => "GetTxnEasInfoResponse",
        "TestMailingRequest" => "TestMailingRequest",
        "OrganizationId" => "OrganizationId",
        "Organization" => "Organization",
        "OrganizationFilter" => "OrganizationFilter",
        "OrganizationOrderBy" => "OrganizationOrderBy",
        "UserId" => "UserId",
        "User" => "User",
        "access" => "access",
        "UserFilter" => "UserFilter",
        "UserOrderBy" => "UserOrderBy",
        "RolePermissions" => "RolePermissions",
        "Permissions" => "Permissions",
        "RoleId" => "RoleId",
        "Role" => "Role",
        "RoleFilter" => "RoleFilter",
        "RoleOrderBy" => "RoleOrderBy",
        "AssignedRoleId" => "AssignedRoleId",
        "AssignedRole" => "AssignedRole",
        "AssignedRoleOrderBy" => "AssignedRoleOrderBy",
        "AssignedRoleFilter" => "AssignedRoleFilter",
        "SystemAddressId" => "SystemAddressId",
        "SystemAddress" => "SystemAddress",
        "SystemAddressType" => "SystemAddressType",
        "SystemAddressFilter" => "SystemAddressFilter",
        "SystemAddressOrderBy" => "SystemAddressOrderBy",
        "CampaignId" => "CampaignId",
        "Campaign" => "Campaign",
        "CampaignFilter" => "CampaignFilter",
        "CampaignOrderBy" => "CampaignOrderBy",
        "MediaServerId" => "MediaServerId",
        "MediaServer" => "MediaServer",
        "server" => "server",
        "MediaServerFilter" => "MediaServerFilter",
        "MediaServerOrderBy" => "MediaServerOrderBy",
        "WebAnalyticsId" => "WebAnalyticsId",
        "WebAnalytics" => "WebAnalytics",
        "WebAnalyticsFilter" => "WebAnalyticsFilter",
        "WebAnalyticsOrderBy" => "WebAnalyticsOrderBy",
        "MailingClassId" => "MailingClassId",
        "MailingClass" => "MailingClass",
        "MailingClassFilter" => "MailingClassFilter",
        "MailingClassOrderBy" => "MailingClassOrderBy",
        "Forward2FriendOfferTrackingOption" => "Forward2FriendOfferTrackingOption",
        "StrongtoolOpenAs" => "StrongtoolOpenAs",
        "StrongtoolId" => "StrongtoolId",
        "Strongtool" => "Strongtool",
        "StrongtoolOrderBy" => "StrongtoolOrderBy",
        "StrongtoolFilter" => "StrongtoolFilter",
        "OrganizationToken" => "OrganizationToken",
        "IsSSO" => "IsSSO",
        "DayOfWeek" => "DayOfWeek",
        "DayOfMonth" => "DayOfMonth",
        "Month" => "Month",
        "NameValuePair" => "NameValuePair",
        "Token" => "Token",
        "FilterBooleanScalarOperator" => "FilterBooleanScalarOperator",
        "FilterIdScalarOperator" => "FilterIdScalarOperator",
        "FilterIntegerScalarOperator" => "FilterIntegerScalarOperator",
        "FilterStringScalarOperator" => "FilterStringScalarOperator",
        "FilterArrayOperator" => "FilterArrayOperator",
        "FilterCondition" => "FilterCondition",
        "BooleanFilterCondition" => "BooleanFilterCondition",
        "ScalarBooleanFilterCondition" => "ScalarBooleanFilterCondition",
        "IntegerFilterCondition" => "IntegerFilterCondition",
        "ScalarIntegerFilterCondition" => "ScalarIntegerFilterCondition",
        "ArrayIntegerFilterCondition" => "ArrayIntegerFilterCondition",
        "IdFilterCondition" => "IdFilterCondition",
        "ScalarIdFilterCondition" => "ScalarIdFilterCondition",
        "ArrayIdFilterCondition" => "ArrayIdFilterCondition",
        "StringFilterCondition" => "StringFilterCondition",
        "ScalarStringFilterCondition" => "ScalarStringFilterCondition",
        "ArrayStringFilterCondition" => "ArrayStringFilterCondition",
        "ComparisonOperation" => "ComparisonOperation",
        "LogicalOperation" => "LogicalOperation",
        "AddRecordsResponse" => "AddRecordsResponse",
        "CopyResponse" => "CopyResponse",
        "CreateRequest" => "CreateRequest",
        "BatchCreateResponse" => "BatchCreateResponse",
        "CreateResponse" => "CreateResponse",
        "ExportRecordsResponse" => "ExportRecordsResponse",
        "DeleteRequest" => "DeleteRequest",
        "BatchDeleteResponse" => "BatchDeleteResponse",
        "DeleteResponse" => "DeleteResponse",
        "GetRequest" => "GetRequest",
        "BatchGetResponse" => "BatchGetResponse",
        "GetResponse" => "GetResponse",
        "BatchUpdateResponse" => "BatchUpdateResponse",
        "ImportContentResponse" => "ImportContentResponse",
        "ListRequest" => "ListRequest",
        "ListResponse" => "ListResponse",
        "RemoveRecordsResponse" => "RemoveRecordsResponse",
        "TestResponse" => "TestResponse",
        "UpdateRequest" => "UpdateRequest",
        "UpdateResponse" => "UpdateResponse",
        "CharSet" => "CharSet",
        "Encoding" => "Encoding",
        "FaultCode" => "FaultCode",
        "FaultMessage" => "FaultMessage",
        "FaultDetail" => "FaultDetail",
        "AuthorizationFaultDetail" => "AuthorizationFaultDetail",
        "ConcurrentModificationFaultDetail" => "ConcurrentModificationFaultDetail",
        "InvalidObjectFaultDetail" => "InvalidObjectFaultDetail",
        "ObjectNotFoundFaultDetail" => "ObjectNotFoundFaultDetail",
        "StaleObjectFaultDetail" => "StaleObjectFaultDetail",
        "UnexpectedFaultDetail" => "UnexpectedFaultDetail",
        "UnrecognizedObjectTypeFaultDetail" => "UnrecognizedObjectTypeFaultDetail",
        "BadHandleFaultDetail" => "BadHandleFaultDetail",
    );

    /**
     * Constructor using wsdl location and options array
     * @param string $wsdl WSDL location for this service
     * @param array $options Options for the SoapClient
     */
    public function __construct($wsdl="MailingService.wsdl", $options=array()) {
        foreach(self::$classmap as $wsdlClassName => $phpClassName) {
            if(!isset($options['classmap'][$wsdlClassName])) {
                $options['classmap'][$wsdlClassName] = $phpClassName;
            }
        }
        parent::__construct($wsdl, $options);
    }

        private function splitTypesString($arr)
        {
          $tempArray = split('[\)\(]+', $arr);
          unset($tempArray[count($tempArray)-1]);
          unset($tempArray[0]);
          return array_values($tempArray);
        }
        
    /**
     * Checks if an argument list matches against a valid argument type list
     * @param array $arguments The argument list to check
     * @param array $validParameters A list of valid argument types
     * @return boolean true if arguments match against validParameters
     * @throws Exception invalid function signature message
     */
    public function _checkArguments($arguments, $validParameters)
        {
          $variables = "";
          foreach ($arguments as $arg)
          {
            $type = gettype($arg);
            if ($type == "object")
            {
              $type = get_class($arg);
            }
            $variables .= "(".$type.")";
          }
        
          if (!in_array($variables, $validParameters))
          {
            // Check for superclasses
            $myVarArray = $this->splitTypesString($variables);
        
            foreach ($validParameters as $vP)
            {
              $myParamArray = $this->splitTypesString($vP);
        
              if (count($myVarArray) != count($myParamArray))
              {
                continue;
              }
        
              $matches = 0;
              for ($i=0; $i<count($myParamArray); $i++)
              {
                if (class_exists($myVarArray[$i]) && class_exists($myParamArray[$i]))
                {
                  $reflectionClass1 = new ReflectionClass($myVarArray[$i]);
                  $reflectionClass2 = new ReflectionClass($myParamArray[$i]);
        
                  if ($reflectionClass1->isSubclassOf($reflectionClass2))
                  {
                    $matches++;
                  }
                }
                else
                {
                  if ($myVarArray[$i] == $myParamArray[$i])
                  {
                    $matches++;
                  }
                }
              }
        
              if ($matches == count($myParamArray))
              {
                return true;
              }
            }
            throw new Exception("Invalid parameter types: ".str_replace(")(", ", ", $variables));
          }
          return true;
    }

    /**
     * Service Call: addRecords
     * Parameter options:
     * (AddRecordsRequest) addRecords
     * @param mixed,... See function description for parameter options
     * @return AddRecordsResponse
     * @throws Exception invalid function signature message
     */
    public function addRecords($mixed = null) {
        $validParameters = array(
            "(AddRecordsRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("addRecords", $args);
    }


    /**
     * Service Call: archive
     * Parameter options:
     * (ArchiveRequest) archive
     * @param mixed,... See function description for parameter options
     * @return ArchiveResponse
     * @throws Exception invalid function signature message
     */
    public function archive($mixed = null) {
        $validParameters = array(
            "(ArchiveRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("archive", $args);
    }


    /**
     * Service Call: cancel
     * Parameter options:
     * (CancelRequest) cancel
     * @param mixed,... See function description for parameter options
     * @return CancelResponse
     * @throws Exception invalid function signature message
     */
    public function cancel($mixed = null) {
        $validParameters = array(
            "(CancelRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("cancel", $args);
    }


    /**
     * Service Call: cancelRefreshRecords
     * Parameter options:
     * (CancelRefreshRecordsRequest) cancelRefreshRecords
     * @param mixed,... See function description for parameter options
     * @return CancelRefreshRecordsResponse
     * @throws Exception invalid function signature message
     */
    public function cancelRefreshRecords($mixed = null) {
        $validParameters = array(
            "(CancelRefreshRecordsRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("cancelRefreshRecords", $args);
    }


    /**
     * Service Call: close
     * Parameter options:
     * (CloseRequest) close
     * @param mixed,... See function description for parameter options
     * @return CloseResponse
     * @throws Exception invalid function signature message
     */
    public function close($mixed = null) {
        $validParameters = array(
            "(CloseRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("close", $args);
    }


    /**
     * Service Call: copy
     * Parameter options:
     * (CopyRequest) copy
     * @param mixed,... See function description for parameter options
     * @return CopyResponse
     * @throws Exception invalid function signature message
     */
    public function copy($mixed = null) {
        $validParameters = array(
            "(CopyRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("copy", $args);
    }


    /**
     * Service Call: create
     * Parameter options:
     * (CreateRequest) create
     * @param mixed,... See function description for parameter options
     * @return BatchCreateResponse
     * @throws Exception invalid function signature message
     */
    public function create($mixed = null) {
        $validParameters = array(
            "(CreateRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("create", $args);
    }


    /**
     * Service Call: dedupeRecords
     * Parameter options:
     * (DedupeRecordsRequest) dedupeRecords
     * @param mixed,... See function description for parameter options
     * @return DedupeRecordsResponse
     * @throws Exception invalid function signature message
     */
    public function dedupeRecords($mixed = null) {
        $validParameters = array(
            "(DedupeRecordsRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("dedupeRecords", $args);
    }


    /**
     * Service Call: delete
     * Parameter options:
     * (DeleteRequest) delete
     * @param mixed,... See function description for parameter options
     * @return BatchDeleteResponse
     * @throws Exception invalid function signature message
     */
    public function delete($mixed = null) {
        $validParameters = array(
            "(DeleteRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("delete", $args);
    }


    /**
     * Service Call: exportRecords
     * Parameter options:
     * (ExportRecordsRequest) exportRecords
     * @param mixed,... See function description for parameter options
     * @return ExportRecordsResponse
     * @throws Exception invalid function signature message
     */
    public function exportRecords($mixed = null) {
        $validParameters = array(
            "(ExportRecordsRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("exportRecords", $args);
    }


    /**
     * Service Call: get
     * Parameter options:
     * (GetRequest) get
     * @param mixed,... See function description for parameter options
     * @return BatchGetResponse
     * @throws Exception invalid function signature message
     */
    public function get($mixed = null) {
        $validParameters = array(
            "(GetRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("get", $args);
    }


    /**
     * Service Call: getStatistics
     * Parameter options:
     * (GetStatisticsRequest) getStatistics
     * @param mixed,... See function description for parameter options
     * @return GetStatisticsResponse
     * @throws Exception invalid function signature message
     */
    public function getStatistics($mixed = null) {
        $validParameters = array(
            "(GetStatisticsRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("getStatistics", $args);
    }


    /**
     * Service Call: importContent
     * Parameter options:
     * (ImportContentRequest) importContent
     * @param mixed,... See function description for parameter options
     * @return ImportContentResponse
     * @throws Exception invalid function signature message
     */
    public function importContent($mixed = null) {
        $validParameters = array(
            "(ImportContentRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("importContent", $args);
    }


    /**
     * Service Call: importMessagePart
     * Parameter options:
     * (ImportMessagePartRequest) importMessagePart
     * @param mixed,... See function description for parameter options
     * @return ImportMessagePartResponse
     * @throws Exception invalid function signature message
     */
    public function importMessagePart($mixed = null) {
        $validParameters = array(
            "(ImportMessagePartRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("importMessagePart", $args);
    }


    /**
     * Service Call: launch
     * Parameter options:
     * (LaunchRequest) launch
     * @param mixed,... See function description for parameter options
     * @return LaunchResponse
     * @throws Exception invalid function signature message
     */
    public function launch($mixed = null) {
        $validParameters = array(
            "(LaunchRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("launch", $args);
    }


    /**
     * Service Call: _list
     * Parameter options:
     * (ListRequest) list
     * @param mixed,... See function description for parameter options
     * @return ListResponse
     * @throws Exception invalid function signature message
     */
    public function _list($mixed = null) {
        $validParameters = array(
            "(ListRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("list", $args);
    }


    /**
     * Service Call: load
     * Parameter options:
     * (LoadRequest) load
     * @param mixed,... See function description for parameter options
     * @return LoadResponse
     * @throws Exception invalid function signature message
     */
    public function load($mixed = null) {
        $validParameters = array(
            "(LoadRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("load", $args);
    }


    /**
     * Service Call: pause
     * Parameter options:
     * (PauseRequest) pause
     * @param mixed,... See function description for parameter options
     * @return PauseResponse
     * @throws Exception invalid function signature message
     */
    public function pause($mixed = null) {
        $validParameters = array(
            "(PauseRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("pause", $args);
    }


    /**
     * Service Call: refreshRecords
     * Parameter options:
     * (RefreshRecordsRequest) refreshRecords
     * @param mixed,... See function description for parameter options
     * @return RefreshRecordsResponse
     * @throws Exception invalid function signature message
     */
    public function refreshRecords($mixed = null) {
        $validParameters = array(
            "(RefreshRecordsRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("refreshRecords", $args);
    }


    /**
     * Service Call: removeRecords
     * Parameter options:
     * (RemoveRecordsRequest) removeRecords
     * @param mixed,... See function description for parameter options
     * @return RemoveRecordsResponse
     * @throws Exception invalid function signature message
     */
    public function removeRecords($mixed = null) {
        $validParameters = array(
            "(RemoveRecordsRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("removeRecords", $args);
    }


    /**
     * Service Call: resume
     * Parameter options:
     * (ResumeRequest) resume
     * @param mixed,... See function description for parameter options
     * @return ResumeResponse
     * @throws Exception invalid function signature message
     */
    public function resume($mixed = null) {
        $validParameters = array(
            "(ResumeRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("resume", $args);
    }


    /**
     * Service Call: schedule
     * Parameter options:
     * (ScheduleRequest) schedule
     * @param mixed,... See function description for parameter options
     * @return ScheduleResponse
     * @throws Exception invalid function signature message
     */
    public function schedule($mixed = null) {
        $validParameters = array(
            "(ScheduleRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("schedule", $args);
    }


    /**
     * Service Call: send
     * Parameter options:
     * (SendRequest) send
     * @param mixed,... See function description for parameter options
     * @return SendResponse
     * @throws Exception invalid function signature message
     */
    public function send($mixed = null) {
        $validParameters = array(
            "(SendRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("send", $args);
    }


    /**
     * Service Call: getTxnMailingHandle
     * Parameter options:
     * (GetTxnMailingHandleRequest) getTxnMailingHandle
     * @param mixed,... See function description for parameter options
     * @return GetTxnMailingHandleResponse
     * @throws Exception invalid function signature message
     */
    public function getTxnMailingHandle($mixed = null) {
        $validParameters = array(
            "(GetTxnMailingHandleRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("getTxnMailingHandle", $args);
    }


    /**
     * Service Call: txnSend
     * Parameter options:
     * (TxnSendRequest) txnSend
     * @param mixed,... See function description for parameter options
     * @return TxnSendResponse
     * @throws Exception invalid function signature message
     */
    public function txnSend($mixed = null) {
        $validParameters = array(
            "(TxnSendRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("txnSend", $args);
    }


    /**
     * Service Call: getTxnEasInfo
     * Parameter options:
     * (GetTxnEasInfoRequest) getTxnEasInfo
     * @param mixed,... See function description for parameter options
     * @return GetTxnEasInfoResponse
     * @throws Exception invalid function signature message
     */
    public function getTxnEasInfo($mixed = null) {
        $validParameters = array(
            "(GetTxnEasInfoRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("getTxnEasInfo", $args);
    }


    /**
     * Service Call: test
     * Parameter options:
     * (TestRequest) test
     * @param mixed,... See function description for parameter options
     * @return TestResponse
     * @throws Exception invalid function signature message
     */
    public function test($mixed = null) {
        $validParameters = array(
            "(TestRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("test", $args);
    }


    /**
     * Service Call: update
     * Parameter options:
     * (UpdateRequest) update
     * @param mixed,... See function description for parameter options
     * @return BatchUpdateResponse
     * @throws Exception invalid function signature message
     */
    public function update($mixed = null) {
        $validParameters = array(
            "(UpdateRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("update", $args);
    }


    /**
     * Service Call: validateXsl
     * Parameter options:
     * (ValidateXslRequest) validateXsl
     * @param mixed,... See function description for parameter options
     * @return ValidateXslResponse
     * @throws Exception invalid function signature message
     */
    public function validateXsl($mixed = null) {
        $validParameters = array(
            "(ValidateXslRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("validateXsl", $args);
    }


    /**
     * Service Call: fetchLinks
     * Parameter options:
     * (FetchLinksRequest) fetchLinks
     * @param mixed,... See function description for parameter options
     * @return FetchLinksResponse
     * @throws Exception invalid function signature message
     */
    public function fetchLinks($mixed = null) {
        $validParameters = array(
            "(FetchLinksRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("fetchLinks", $args);
    }


    /**
     * Service Call: getSingleSignOnURL
     * Parameter options:
     * (GetSingleSignOnURLRequest) getSingleSignOnURL
     * @param mixed,... See function description for parameter options
     * @return GetSingleSignOnURLResponse
     * @throws Exception invalid function signature message
     */
    public function getSingleSignOnURL($mixed = null) {
        $validParameters = array(
            "(GetSingleSignOnURLRequest)",
        );
        $args = func_get_args();
        $this->_checkArguments($args, $validParameters);
        return $this->__soapCall("getSingleSignOnURL", $args);
    }


}}

?>