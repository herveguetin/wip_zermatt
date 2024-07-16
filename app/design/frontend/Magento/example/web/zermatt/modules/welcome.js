export default {
    greet(customerCode) {
        const customer = Zermatt.Variables.customers.find(customer => customer.code === customerCode)
        return customer.message + customer.name
    }
}
