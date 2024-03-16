/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */
define(
    [
        'ko',
        'uiComponent'
    ],
    function (ko, Component) {
        'use strict'

        return Component.extend({
            message: ko.observable(''),
            initialize: function () {
                document.addEventListener('zermatt_example:alpine_input', function (event) {
                    this.message(event.detail)
                }.bind(this))
            }
        })
    }
)
