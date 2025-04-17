import serial
import time
import tkinter as tk
from tkinter import messagebox
import threading

# Configuración del puerto serie
try:
    arduino = serial.Serial(port='COM3', baudrate=9600, timeout=1)  # Cambia 'COM3' según tu puerto
    time.sleep(2)  # Esperar a que el Arduino esté listo
except Exception as e:
    messagebox.showerror("Error", f"No se pudo conectar al Arduino: {e}")
    exit()

def send_command(command):
    """Envía un comando al Arduino."""
    try:
        arduino.write(f"{command}\n".encode())
        time.sleep(0.1)
    except Exception as e:
        messagebox.showerror("Error", f"Error enviando comando: {e}")

def read_response(timeout=2):
    """Lee la respuesta del Arduino con un tiempo límite."""
    start_time = time.time()
    while time.time() - start_time < timeout:
        if arduino.in_waiting > 0:
            return arduino.readline().decode().strip()
    return None

def process_response():
    """Procesa la respuesta del Arduino de manera asíncrona."""
    start_time = time.time()
    timeout = 5
    while time.time() - start_time < timeout:
        response = read_response()
        if response:
            log_text.insert(tk.END, f"Arduino dice: {response}\n")
            log_text.see(tk.END)

            if "Ingrese el ID" in response:
                id_number = simple_input_dialog("Solicitud de ID", "Por favor, escribe el ID (1-127):")
                if id_number:
                    send_command(id_number)

            if response in ["LED apagado", "Huella guardada exitosamente!", "Error al guardar la huella"]:
                return
            elif response.startswith("ERROR"):
                messagebox.showerror("Error", "Hubo un problema durante el proceso.")
                return

def handle_command():
    """Maneja el comando del usuario y procesa la respuesta sin congelar la interfaz."""
    command = command_entry.get().strip().upper()
    if command == "EXIT":
        root.destroy()
        arduino.close()
        return
    send_command(command)
    threading.Thread(target=process_response, daemon=True).start()  # Usamos un hilo para no bloquear la interfaz

def simple_input_dialog(title, prompt):
    """Muestra un diálogo para ingresar datos (como el ID)."""
    def submit():
        user_input.set(entry.get())
        dialog.destroy()

    dialog = tk.Toplevel(root)
    dialog.title(title)
    tk.Label(dialog, text=prompt).pack(pady=5)
    user_input = tk.StringVar()
    entry = tk.Entry(dialog, textvariable=user_input)
    entry.pack(pady=5)
    tk.Button(dialog, text="Aceptar", command=submit).pack(pady=5)
    dialog.grab_set()
    root.wait_window(dialog)
    return user_input.get()

# Configuración de la ventana principal
root = tk.Tk()
root.title("Control Arduino - Huella Dactilar")
root.configure(bg="#f0f8ff")  # Fondo azul claro

# Crear el campo de texto para comandos
command_label = tk.Label(root, text="Ingresa la acción:", bg="#f0f8ff", fg="#000080", font=("Arial", 12, "bold"))
command_label.pack(pady=10)

command_entry = tk.Entry(root, width=30, font=("Arial", 10))
command_entry.pack(pady=5)

# Botón de OK para enviar comando
ok_button = tk.Button(root, text="CONTINUAR", command=handle_command, bg="#4682b4", fg="white", font=("Arial", 10, "bold"))
ok_button.pack(pady=10)

# Label de instrucciones
instructions_label = tk.Label(root, text="Instrucciones: Ingresa el comando y presiona CONTINUAR.", bg="#f0f8ff", fg="#2f4f4f", font=("Arial", 10))
instructions_label.pack(pady=5)

instructions_label = tk.Label(root, text="ON:INGRESAR LA HUELLA, CONTINUAR.", bg="#f0f8ff", fg="#2f4f4f", font=("Arial", 10))
instructions_label.pack(pady=5)
instructions_label = tk.Label(root, text="OFF:CIERRA LA HUELLA", bg="#f0f8ff", fg="#2f4f4f", font=("Arial", 10))
instructions_label.pack(pady=5)
instructions_label = tk.Label(root, text="EXIT:CIERRA LA APP", bg="#f0f8ff", fg="#2f4f4f", font=("Arial", 10))
instructions_label.pack(pady=5)



# Crear área de registro de respuestas
log_text = tk.Text(root, height=5, width=50, state="normal", bg="#e6f7ff", fg="#000080", font=("Courier", 10))
log_text.pack(pady=10)
log_text.insert(tk.END, "Interfaz lista. Conéctate con Arduino para comenzar.\n")

root.mainloop()