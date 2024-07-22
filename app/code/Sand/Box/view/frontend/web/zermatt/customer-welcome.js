/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

const customerData = Zermatt.Variables.customerData
export default {
    async greet() {
        await new Promise((resolve) => setTimeout(resolve, 200));
        Zermatt.Event.dispatch('SandBox:init', {status: 'init'})
        await new Promise((resolve) => setTimeout(resolve, 200));
        Zermatt.Event.dispatch('SandBox:loaded', {status: 'loaded'})
        return `Hello ${customerData.firstName} ${customerData.lastName} and welcome!`
    }
}
