<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protobuf/gtfs-realtime.proto

namespace GPBMetadata\Protobuf;

class GtfsRealtime
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�#
protobuf/gtfs-realtime.protogoogle.transit.realtime"w
FeedMessage3
header (2#.google.transit.realtime.FeedHeader3
entity (2#.google.transit.realtime.FeedEntity"�

FeedHeader
gtfs_realtime_version (	J
incrementality (22.google.transit.realtime.FeedHeader.Incrementality
	timestamp ("4
Incrementality
FULL_DATASET 
DIFFERENTIAL"�

FeedEntity

id (	

is_deleted (8
trip_update (2#.google.transit.realtime.TripUpdate9
vehicle (2(.google.transit.realtime.VehiclePosition-
alert (2.google.transit.realtime.Alert"�

TripUpdate5
trip (2\'.google.transit.realtime.TripDescriptor;
vehicle (2*.google.transit.realtime.VehicleDescriptorL
stop_time_update (22.google.transit.realtime.TripUpdate.StopTimeUpdate
	timestamp (
delay (A
StopTimeEvent
delay (
time (
uncertainty (�
StopTimeUpdate
stop_sequence (
stop_id (	B
arrival (21.google.transit.realtime.TripUpdate.StopTimeEventD
	departure (21.google.transit.realtime.TripUpdate.StopTimeEventf
schedule_relationship (2G.google.transit.realtime.TripUpdate.StopTimeUpdate.ScheduleRelationship"?
ScheduleRelationship
	SCHEDULED 
SKIPPED
NO_DATA"�
VehiclePosition5
trip (2\'.google.transit.realtime.TripDescriptor;
vehicle (2*.google.transit.realtime.VehicleDescriptor3
position (2!.google.transit.realtime.Position
current_stop_sequence (
stop_id (	R
current_status (2:.google.transit.realtime.VehiclePosition.VehicleStopStatus
	timestamp (R
congestion_level (28.google.transit.realtime.VehiclePosition.CongestionLevelR
occupancy_status	 (28.google.transit.realtime.VehiclePosition.OccupancyStatus"G
VehicleStopStatus
INCOMING_AT 

STOPPED_AT
IN_TRANSIT_TO"}
CongestionLevel
UNKNOWN_CONGESTION_LEVEL 
RUNNING_SMOOTHLY
STOP_AND_GO

CONGESTION
SEVERE_CONGESTION"�
OccupancyStatus	
EMPTY 
MANY_SEATS_AVAILABLE
FEW_SEATS_AVAILABLE
STANDING_ROOM_ONLY
CRUSHED_STANDING_ROOM_ONLY
FULL
NOT_ACCEPTING_PASSENGERS"�

Alert9
active_period (2".google.transit.realtime.TimeRange@
informed_entity (2\'.google.transit.realtime.EntitySelector3
cause (2$.google.transit.realtime.Alert.Cause5
effect (2%.google.transit.realtime.Alert.Effect6
url (2).google.transit.realtime.TranslatedString>
header_text
 (2).google.transit.realtime.TranslatedStringC
description_text (2).google.transit.realtime.TranslatedStringB
tts_header_text (2).google.transit.realtime.TranslatedStringG
tts_description_text (2).google.transit.realtime.TranslatedStringD
severity_level (2,.google.transit.realtime.Alert.SeverityLevel7
image (2(.google.transit.realtime.TranslatedImageI
image_alternative_text (2).google.transit.realtime.TranslatedString"�
Cause
PROTO3_DEFAULT_CAUSE 
UNKNOWN_CAUSE
OTHER_CAUSE
TECHNICAL_PROBLEM

STRIKE
DEMONSTRATION
ACCIDENT
HOLIDAY
WEATHER
MAINTENANCE	
CONSTRUCTION

POLICE_ACTIVITY
MEDICAL_EMERGENCY"�
Effect
PROTO3_DEFAULT_EFFECT 

NO_SERVICE
REDUCED_SERVICE
SIGNIFICANT_DELAYS

DETOUR
ADDITIONAL_SERVICE
MODIFIED_SERVICE
OTHER_EFFECT
UNKNOWN_EFFECT

STOP_MOVED	"k
SeverityLevel!
PROTO3_DEFAULT_SEVERITY_LEVEL 
UNKNOWN_SEVERITY
INFO
WARNING

SEVERE"\'
	TimeRange
start (
end ("a
Position
latitude (
	longitude (
bearing (
odometer (
speed ("�
TripDescriptor
trip_id (	
route_id (	
direction_id (

start_time (	

start_date (	[
schedule_relationship (2<.google.transit.realtime.TripDescriptor.ScheduleRelationship"O
ScheduleRelationship
	SCHEDULED 	
ADDED
UNSCHEDULED
CANCELED"E
VehicleDescriptor

id (	
label (	
license_plate (	"�
EntitySelector
	agency_id (	
route_id (	

route_type (5
trip (2\'.google.transit.realtime.TripDescriptor
stop_id (	"�
TranslatedStringJ
translation (25.google.transit.realtime.TranslatedString.Translation-
Translation
text (	
language (	"�
TranslatedImageP
localized_image (27.google.transit.realtime.TranslatedImage.LocalizedImageC
LocalizedImage
url (	

media_type (	
language (	"3
Shape
shape_id (	
encoded_polyline (	B
com.google.transit.realtimebproto3'
        , true);

        static::$is_initialized = true;
    }
}

