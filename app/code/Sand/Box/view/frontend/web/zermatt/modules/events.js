/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */
export default {
    init() {
        Zermatt.Event.on('button:click', this.onButtonClick)
    },

    onButtonClick() {
        console.log('clicked!')
    },

    click() {
        Zermatt.Event.dispatch('button:click')
    }
}
