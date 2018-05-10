;
(function() {

    window.jsPlumbDemo = {
        init: function() {

//			jsPlumb.importDefaults({
//				// default drag options
//				DragOptions : { cursor: 'pointer', zIndex:2000 },
//				// default to blue at one end and green at the other
//				EndpointStyles : [{ fillStyle:'#225588' }, { fillStyle:'#558822' }],
//				// blue endpoints 7 px; green endpoints 11.
//				Endpoints : [ [ "Dot", {radius:7} ], [ "Dot", { radius:11 } ]],
//				// the overlays to decorate each connection with.  note that the label overlay uses a function to generate the label text; in this
//				// case it returns the 'labelText' member that we set on each connection in the 'init' method below.
//				ConnectionOverlays : [
//					[ "Arrow", { location:-5 } ],
//					[ "Label", { 
//						location:0.1,
//						id:"label",
//						cssClass:"aLabel"
//					}]
//				]
//			});			

            // this is the paint style for the connecting lines..
//			var connectorPaintStyle = {
//				lineWidth:0.5,
//				strokeStyle:"#505050",
//				//joinstyle:"round",
//				outlineColor:"#505050",
//				//outlineWidth:2
//			},
//			// .. and this is the hover style. 
//			connectorHoverStyle = {
//				lineWidth:2,
//				strokeStyle:"#2e2aF8"
//			},

            var connectorPaintStyle = {
                lineWidth: 0.5,
                strokeStyle: "#7eb24c",
                //joinstyle:"round",
                outlineColor: "#7eb24c",
                outlineWidth: 0.5
            },
            // .. and this is the hover style. 
            connectorHoverStyle = {
                lineWidth:3,
                strokeStyle:"#2e2aF8"
            },
                    endpointHoverStyle = {fillStyle: "#2e2aF8"},
            // the definition of source endpoints (the small blue ones)
            sourceEndpoint = {
                endpoint: "Dot",
                paintStyle: {
                    strokeStyle: "#225588",
                    fillStyle: "transparent",
                    radius: 7,
                    lineWidth: 2
                },
                isSource: true,
                connector: ["Flowchart", {
                        stub: [12, 18],
                        gap: 1,
                        cornerRadius: 5,
                        alwaysRespectStubs: true}],
                connectorStyle: connectorPaintStyle,
                hoverPaintStyle: endpointHoverStyle,
                connectorHoverStyle: connectorHoverStyle,
                dragOptions: {},
                overlays: [
                    ["Label", {
                            location: [0.5, 1.5],
                            //label:"Drag",
                            cssClass: "endpointSourceLabel"
                        }]
                ]
            },
            // a source endpoint that sits at BottomCenter
            //	bottomSource = jsPlumb.extend( { anchor:"BottomCenter" }, sourceEndpoint),
            // the definition of target endpoints (will appear when the user drags a connection) 
            targetEndpoint = {
                endpoint: "Dot",
                paintStyle: {fillStyle: "#558822",
                    radius: 9},
                hoverPaintStyle: endpointHoverStyle,
                maxConnections: -1,
                dropOptions: {hoverClass: "hover", activeClass: "active"},
                isTarget: true,
                overlays: [
                    ["Label", {location: [0.5, -0.5],
                            //label:"Drop", 
                            cssClass: "endpointTargetLabel"}]
                ]
            },
            init = function(connection) {
                //connection.getOverlay("label").setLabel(connection.sourceId.substring(6) + "-" + connection.targetId.substring(6));
                connection.bind("editCompleted", function(o) {
//					if (typeof console != "undefined"){
//						console.log("connection edited. path is now ", o.path);
//                                        }
                });
            };

            var allSourceEndpoints = [], allTargetEndpoints = [];
            _addEndpoints = function(toId, sourceAnchors, targetAnchors) {
                for (var i = 0; i < sourceAnchors.length; i++) {
                    var sourceUUID = toId + sourceAnchors[i];
                    allSourceEndpoints.push(jsPlumb.addEndpoint(toId, sourceEndpoint, {anchor: sourceAnchors[i], uuid: sourceUUID}));
                }
                for (var j = 0; j < targetAnchors.length; j++) {
                    var targetUUID = toId + targetAnchors[j];
                    allTargetEndpoints.push(jsPlumb.addEndpoint(toId, targetEndpoint, {anchor: targetAnchors[j], uuid: targetUUID}));
                }
            };


        }
    };
})();