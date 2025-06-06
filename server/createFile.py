from fpdf import FPDF

user = "Danoninodan"
props = ["productos", "cantidad", "Precio unitario", "Total"]

address= "una direccion"
sell = [["uno", "2", "$200", "400"], ["tres", "2", "$500", "1000"]]

"""pdf = FPDF()
pdf.add_page()
pdf.set_font("Arial", size=12)

pdf.cell(200, 10, txt="FACTURA - T O T A L S N E A K E R S", ln=True, align='C')
pdf.cell(200, 10, txt="Gracias por comprar en ", ln=False, align='L')
col_widths = [40, 30, 50]

# Print headers
for i, header in enumerate(props):
    pdf.cell(col_widths[i-1], 10, header, border=1, align='L')
pdf.ln()

# Print rows
for row in sell:
    for i, item in enumerate(row):
        pdf.cell(col_widths[i-1], 10, item, border=1, align='L')
    pdf.ln()


pdf.output(f"Factura {user}.pdf")"""

class PDF(FPDF):
    def header(self):
        self.set_font("Arial", "B", 14)
        self.cell(0, 10, "FACTURACIÓN", ln=True, align='C')
        self.ln(5)

pdf = PDF()
pdf.add_page()

# Set font
pdf.set_font("Arial", size=12)
pdf.multi_cell(0, 10, "Gracias por confiar en nosotros")
pdf.cell(100, 10, "Información del vendedor:")
pdf.ln(6)
pdf.cell(100, 10, "TotalSneakers Inc.")
pdf.ln(6)
pdf.cell(100, 10, "Aquí")
pdf.ln(6)
pdf.cell(100, 10, "oih")
pdf.ln(6)
pdf.cell(100, 10, "Email: totalSneakersScholarProject@gmail.com")
pdf.ln(6)
pdf.cell(100, 10, "Phone: +52 1111 1111")
pdf.ln(12)

pdf.cell(100, 10, "Información del comprador:")
pdf.ln(6)
pdf.cell(100, 10, f"Nombre del cliente: {user}")
pdf.ln(6)
pdf.cell(100, 10, "Dirección: 789 Main Street")
pdf.ln(6)
pdf.cell(100, 10, "Email: john@example.com")
pdf.ln(6)
pdf.cell(100, 10, "Teléfono: (987) 654-3210")
pdf.ln(12)

# Invoice Info
pdf.cell(100, 10, "Invoice Number: 001234")
pdf.ln(6)
pdf.cell(100, 10, "Date of Issue: June 4, 2025")
pdf.ln(6)
pdf.cell(100, 10, "Due Date: June 11, 2025")
pdf.ln(12)

# Table Header
pdf.set_font("Arial", "B", 12)
pdf.cell(60, 10, "Item", border=1)
pdf.cell(30, 10, "Quantity", border=1)
pdf.cell(40, 10, "Unit Price", border=1)
pdf.cell(40, 10, "Total", border=1)
pdf.ln()

# Table Rows
pdf.set_font("Arial", size=12)
items = [
    ("Air Runner Sneakers", 1, 89.99),
    ("Cleaning Kit", 1, 14.99),
    ("Laces Pack (3 pairs)", 2, 5.00)
]

total = 0

for item, qty, price in items:
    line_total = qty * price
    total += line_total
    pdf.cell(60, 10, item, border=1)
    pdf.cell(30, 10, str(qty), border=1)
    pdf.cell(40, 10, f"${price:.2f}", border=1)
    pdf.cell(40, 10, f"${line_total:.2f}", border=1)
    pdf.ln()

# Summary
tax = total * 0.10
grand_total = total + tax
pdf.ln(5)
pdf.cell(130, 10, "Subtotal:")
pdf.cell(40, 10, f"${total:.2f}")
pdf.ln()
pdf.cell(130, 10, "Tax (10%):")
pdf.cell(40, 10, f"${tax:.2f}")
pdf.ln()
pdf.set_font("Arial", "B", 12)
pdf.cell(130, 10, "Total Amount Due:")
pdf.cell(40, 10, f"${grand_total:.2f}")
pdf.ln(15)

# Payment Method
pdf.set_font("Arial", size=12)
pdf.cell(100, 10, "Payment Method:")
pdf.ln(6)
pdf.cell(100, 10, u"Credit Card")
pdf.ln(6)
pdf.cell(100, 10, u"PayPal")
pdf.ln(6)
pdf.cell(100, 10, u"Bank Transfer")
pdf.ln(12)

# Notes
pdf.set_font("Arial", "I", 11)


# Save the PDF
output_path = f"C:\\xampp\\htdocs\\web page\\server\\FACTURA - {user}.pdf"
pdf.output(output_path)
print(output_path)
