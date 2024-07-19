/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */

const customerData = Zermatt.Variables.customerData
export default {
    greet() {
        return `Hello ${customerData.firstName} ${customerData.lastName} and welcome!`
    }
}
