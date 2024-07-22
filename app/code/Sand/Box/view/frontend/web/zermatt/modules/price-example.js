/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */
export default {
    price: null,
    myFormattedPrice() {
        return Zermatt.Money.formatPrice(this.price, null, 'EUR')
    }
}
