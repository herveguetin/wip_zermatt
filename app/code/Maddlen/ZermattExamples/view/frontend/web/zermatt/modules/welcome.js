export default {
    customerName: '',
    message: 'Welcome',
    greet() {
        return `${this.message} ${this.customerName}!`
    }
}
