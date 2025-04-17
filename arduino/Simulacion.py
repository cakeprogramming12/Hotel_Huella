import serial
import time
import tkinter as tk
from tkinter import messagebox

# Configuración del puerto serie
try:
    arduino = serial.Serial(port='COM3', baudrate=9600, timeout=1)  # Cambia 'COM3' según tu puerto
    time.sleep(2)  # Esperar a que Arduino esté listo
except Exception as e:
    messagebox.showerror("Error", f"No se pudo conectar al Arduino: {e}")
    exit()


def update_status():
    """Lee continuamente los mensajes del Arduino y actualiza la interfaz."""
    try:
        if arduino.in_waiting > 0:
            response = arduino.readline().decode().strip()
            if response:
                log_text.insert(tk.END, f"{response}\n")
                log_text.see(tk.END)

                if "Huella coincidente encontrada" in response:
                    status_label.config(text="Huella coincidente encontrada, PUERTA ABIERTA", fg="green")
                elif "No se detectó dedo, PUERTA CERRADA" in response:
                    status_label.config(text="No se detectó dedo", fg="red")
                elif "Error" in response:
                    status_label.config(text="Error en la detección", fg="orange")

        root.after(100, update_status)  # Llama a esta función de nuevo después de 100ms
    except Exception as e:
        messagebox.showerror("Error", f"Error en la comunicación: {e}")
        root.destroy()


# Configuración de la interfaz gráfica
root = tk.Tk()
root.title("Reconocimiento de Huella")
root.configure(bg="#f0f8ff")  # Fondo azul claro

# Cargar la imagen
try:
    door_image = tk.PhotoImage(file="puerta.png")  # Asegúrate de tener un archivo 'puerta.png' en el mismo directorio
    door_label = tk.Label(root, image=door_image, bg="#f0f8ff")
    door_label.pack(pady=10)  # Coloca la imagen sobre el status_label
except Exception as e:
    messagebox.showerror("Error", f"No se pudo cargar la imagen: {e}")
    exit()

# Etiqueta de estado
status_label = tk.Label(root, text="Esperando interacción...", bg="#f0f8ff", fg="#000080", font=("Arial", 12, "bold"))
status_label.pack(pady=10)

# Área de registro de mensajes
log_text = tk.Text(root, height=10, width=50, state="normal", bg="#e6f7ff", fg="#000080", font=("Courier", 10))
log_text.pack(pady=10)
log_text.insert(tk.END, "Interfaz lista. Esperando datos del Arduino...\n")

# Iniciar la actualización continua del estado
update_status()

# Loop de la interfaz
root.mainloop()