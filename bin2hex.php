<?php

print_r(bin2hex(

            '
�!
protobuf/gtfs-realtime.prototransit_realtime"i
FeedMessage,
header (2.transit_realtime.FeedHeader,
entity (2.transit_realtime.FeedEntity"�

FeedHeader
gtfs_realtime_version (	C
incrementality (2+.transit_realtime.FeedHeader.Incrementality
	timestamp ("4
Incrementality
FULL_DATASET
DIFFERENTIAL"�

FeedEntity

id (	

is_deleted (1
trip_update (2.transit_realtime.TripUpdate2
vehicle (2!.transit_realtime.VehiclePosition&
alert (2.transit_realtime.Alert"�

TripUpdate.
trip (2 .transit_realtime.TripDescriptor4
vehicle (2#.transit_realtime.VehicleDescriptorE
stop_time_update (2+.transit_realtime.TripUpdate.StopTimeUpdate
	timestamp (
delay (A

StopTimeEvent
delay (
time (
uncertainty (�
StopTimeUpdate

stop_sequence (

stop_id (	;
arrival (2*.transit_realtime.TripUpdate.StopTimeEvent=
	departure (2*.transit_realtime.TripUpdate.StopTimeEvent_
schedule_relationship (2@.transit_realtime.TripUpdate.StopTimeUpdate.ScheduleRelationship"?
ScheduleRelationship
	SCHEDULED
SKIPPED
NO_DATA"�
VehiclePosition.
trip (2 .transit_realtime.TripDescriptor4
vehicle (2#.transit_realtime.VehicleDescriptor,
position (2.transit_realtime.Position
current_stop_sequence (

stop_id (	K
current_status (23.transit_realtime.VehiclePosition.VehicleStopStatus
	timestamp (K
congestion_level (21.transit_realtime.VehiclePosition.CongestionLevelK
occupancy_status	 (21.transit_realtime.VehiclePosition.OccupancyStatus"G
VehicleStopStatus
INCOMING_AT

STOPPED_AT

IN_TRANSIT_TO"}
CongestionLevel
UNKNOWN_CONGESTION_LEVEL
RUNNING_SMOOTHLY
STOP_AND_GO

CONGESTION
SEVERE_CONGESTION"�
OccupancyStatus	
EMPTY
MANY_SEATS_AVAILABLE
FEW_SEATS_AVAILABLE
STANDING_ROOM_ONLY
CRUSHED_STANDING_ROOM_ONLY
FULL
NOT_ACCEPTING_PASSENGERS"�	
Alert2

active_period (2.transit_realtime.TimeRange9
informed_entity (2 .transit_realtime.EntitySelector,
cause (2.transit_realtime.Alert.Cause.
effect (2.transit_realtime.Alert.Effect/
url (2".transit_realtime.TranslatedString7
header_text
 (2".transit_realtime.TranslatedString<
description_text (2".transit_realtime.TranslatedString;
tts_header_text (2".transit_realtime.TranslatedString@
tts_description_text
 (2".transit_realtime.TranslatedString=
severity_level (2%.transit_realtime.Alert.SeverityLevel0
image (2!.transit_realtime.TranslatedImageB
image_alternative_text (2".transit_realtime.TranslatedString"�
Cause
PROTO3_DEFAULT_CAUSE

UNKNOWN_CAUSE
OTHER_CAUSE
TECHNICAL_PROBLEM

STRIKE

DEMONSTRATION
ACCIDENT
HOLIDAY
WEATHER
MAINTENANCE	
CONSTRUCTION

POLICE_ACTIVITY
MEDICAL_EMERGENCY"�
Effect
PROTO3_DEFAULT_EFFECT

NO_SERVICE
REDUCED_SERVICE
SIGNIFICANT_DELAYS

DETOUR
ADDITIONAL_SERVICE
MODIFIED_SERVICE
OTHER_EFFECT
UNKNOWN_EFFECT

STOP_MOVED	"k

SeverityLevel!
PROTO3_DEFAULT_SEVERITY_LEVEL
UNKNOWN_SEVERITY
INFO
WARNING

SEVERE"\'
	TimeRange
start (
end ("a
Position
latitude (
	longitude (
bearing (
odometer (
speed ("�
TripDescriptor
trip_id (	
route_id (	
direction_id (


start_time (	

start_date (	T
schedule_relationship (25.transit_realtime.TripDescriptor.ScheduleRelationship"O
ScheduleRelationship
	SCHEDULED	
ADDED
UNSCHEDULED
CANCELED"E
VehicleDescriptor

id (	
label (	

license_plate (	"�
EntitySelector
	agency_id (	
route_id (	

route_type (.
trip (2 .transit_realtime.TripDescriptor
stop_id (	"�
TranslatedStringC
translation (2..transit_realtime.TranslatedString.Translation-
Translation
text (	
language (	"�
TranslatedImageI
localized_image (20.transit_realtime.TranslatedImage.LocalizedImageC
LocalizedImage
url (	

media_type (	
language (	"3
Shape
shape_id (	
encoded_polyline (	B ��gtfs.Google.Transit.Realtimebproto3'
));
