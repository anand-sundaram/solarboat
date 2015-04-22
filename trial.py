import os, subprocess, time

while True:
	output = subprocess.check_output("cat /sys/class/saradc/saradc_ch0", shell=True)
	reading = int(output.strip())
	print reading
	time.sleep(1)
